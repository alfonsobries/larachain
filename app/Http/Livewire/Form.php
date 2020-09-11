<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class Form extends Component
{
    public function updated($name)
    {
        $this->clearValidation($name);
    }
}
