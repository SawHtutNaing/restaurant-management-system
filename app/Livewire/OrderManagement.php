<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class OrderManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public function render()
    {
        $query = Order::query()
            ->where(function ($query) {
                $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
                      ->orWhereHas('meal', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'));
            })
            ->when($this->filterStatus, fn($query) => $query->where('status', $this->filterStatus));

        // Restrict customers to their own orders
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        $orders = $query->with(['user', 'meal'])->paginate(10);

        return view('livewire.order-management', [
            'orders' => $orders,
            'isAdmin' => Auth::user()->isAdmin(),
        ])->layout('layouts.app');
    }

    public function updateStatus($orderId, $status)
    {

        $order = Order::findOrFail($orderId);

        // Restrict non-admins to only cancelling their own orders
        if (!Auth::user()->isAdmin() && ($status !== 'cancelled' || $order->user_id !== Auth::id())) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        if ($status == 'confirmed') {
            if (!$order->canBeConfirmed()) {
                session()->flash('error', 'Cannot confirm order: insufficient inventory.');
                return;
            }

            $order->confirm();
        } else {
            $order->update(['status' => $status]);
        }

        session()->flash('message', 'Order status updated to ' . ucfirst($status) . '.');
    }
}
