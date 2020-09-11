<?php

namespace App\Http\Livewire;

class MobileUserMenu extends UserMenu
{
    public $menuItems = [];

    public function mount($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function render()
    {
        return view('livewire.mobile-user-menu');
    }
}
