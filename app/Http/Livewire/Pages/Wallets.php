<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Wallets extends Component
{
    public function render()
    {
        return view('livewire.pages.wallets')->layout('layouts.guest');
    }
}
