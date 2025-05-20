<?php

namespace App\Livewire;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReservationForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $guests = '';
    public $date = '';
    public $time = '';
    public $notes = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'guests' => 'required|integer|min:1|max:20',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required|in:17:00,17:30,18:00,18:30,19:00,19:30,20:00,20:30,21:00',
        'notes' => 'nullable|string|max:1000',
    ];

    public function submit()
    {
        $this->validate();

        Reservation::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'guests' => $this->guests,
            'date' => $this->date,
            'time' => $this->time,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        $this->reset();
        session()->flash('success', 'Reservation request submitted successfully!');
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
