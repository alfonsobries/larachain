<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RowsLoader extends Component
{
    public $rows;
    public $cols;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rows, $cols)
    {
        $this->rows = $rows;
        $this->cols = $cols;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.rows-loader');
    }
}
