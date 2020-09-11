<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class MobileMenu extends Component
{
    public $menuItems = [];
        
    /**
     * Create a new component instance.
     *
     * @param array $menuItems
     * @return void
     */
    public function __construct($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.layout.mobile-menu');
    }
}
