<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Reservation;

class UserOrdersAndReservations extends Component
{
    use WithPagination;

    public $activeTab = 'orders';
    public $statusFilter = '';
    public $search = '';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
        $this->statusFilter = '';
        $this->search = '';
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();

        if ($this->activeTab === 'orders') {
            $query = Order::with('meal')->where('user_id', $user->id);
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
            if ($this->search) {
                $query->whereHas('meal', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            }
            $orders = $query->latest()->paginate(10);
            $reservations = collect(); // Empty collection for reservations
        } else {
            $query = Reservation::where('user_id', $user->id);
            if ($this->statusFilter) {
                $query->where('status', $this->statusFilter);
            }
            if ($this->search) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
            }
            $reservations = $query->latest()->paginate(10);
            $orders = collect(); // Empty collection for orders
        }

        return view('livewire.user-orders-and-reservations', [
            'orders' => $orders,
            'reservations' => $reservations,
        ])->layout('layouts.app');
    }
}

