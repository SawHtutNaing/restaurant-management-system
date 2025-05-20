<?php

namespace App\Livewire;

use App\Models\Reservation;
use Livewire\Component;

class ReservationManager extends Component
{
    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);
        session()->flash('success', 'Reservation confirmed successfully.');
    }

    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'rejected']);
        session()->flash('success', 'Reservation rejected successfully.');
    }

    public function pending($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'pending']);
        session()->flash('success', 'Reservation set to pending successfully.');
    }

    public function render()
    {
        $reservations = Reservation::with('user')->orderBy('created_at', 'desc')->get();
        return view('livewire.reservation-manager', compact('reservations'))
        ->layout('layouts.app');
        ;
    }
}
