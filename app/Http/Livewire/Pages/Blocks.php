<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Blocks extends Component
{
    public function render()
    {
        return view('livewire.pages.blocks')->layout('layouts.guest');
    }
}
