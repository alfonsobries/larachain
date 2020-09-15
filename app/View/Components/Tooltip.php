<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tooltip extends Component
{
    /**
     * The tooltip
     *
     * @var string
     */
    public $tooltip;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tooltip)
    {
        $this->tooltip = $tooltip;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tooltip');
    }
}
