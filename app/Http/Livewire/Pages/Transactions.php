<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Transactions extends Component
{
    public function render()
    {
        return view('livewire.pages.transactions')->layout('layouts.guest');
    }
}
