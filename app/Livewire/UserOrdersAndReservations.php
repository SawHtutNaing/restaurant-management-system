<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Reservation;

class UserOrdersAndReservations extends Component
{
    public $orders;
    public $reservations;

    public function mount()
    {
        $user = Auth::user();
        $this->orders = Order::with('meal')->where('user_id', $user->id)->latest()->get();
        $this->reservations = Reservation::where('user_id', $user->id)->latest()->get();
    }

    public function render()
    {
        return view('livewire.user-orders-and-reservations')->layout('layouts.app');
    }
}
