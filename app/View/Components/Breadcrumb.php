<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $backUrl = '';
    
    public $items = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($backUrl = '', $items = [])
    {
        $this->backUrl = $backUrl;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
