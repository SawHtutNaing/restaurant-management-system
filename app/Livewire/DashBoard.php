<?php

namespace App\Livewire;

use Livewire\Component;

class DashBoard extends Component
{



    public function render()
    {
        return view('welcome')->layout('layouts.app');
    }
}
