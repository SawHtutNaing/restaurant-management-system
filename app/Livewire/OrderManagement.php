<?php
namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public function render()
    {
        $orders = Order::query()
            ->whereHas('user', fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orWhereHas('meal', fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->filterStatus, fn($query) => $query->where('status', $this->filterStatus))
            ->with(['user', 'meal'])
            ->paginate(10);

        return view('livewire.order-management', [
            'orders' => $orders,
        ])->layout('layouts.app');
    }

    public function updateStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);

        if ($status === 'confirmed') {
            if (!$order->canBeConfirmed()) {
                session()->flash('error', 'Cannot confirm order: insufficient inventory.');
                return;
            }
            $order->confirm();
        } else {
            $order->update(['status' => $status]);
        }

        session()->flash('message', 'Order status updated successfully.');
    }
}
