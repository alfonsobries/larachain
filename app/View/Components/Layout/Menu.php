<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.layout.menu');
    }
}
