<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableHeader extends Component
{
    public $orderable = [];
    public $headers = [];
    public $orderBy = null;

    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orderable, $headers, $orderBy)
    {
        $this->orderable = $orderable;
        $this->headers = $headers;
        $this->orderBy = $orderBy;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table-header');
    }
}
