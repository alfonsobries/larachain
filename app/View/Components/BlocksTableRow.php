<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlocksTableRow extends Component
{
    public $row;
    public $headers;
    public $responsive;
    public $odd;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($row, $headers, $responsive = false, $odd = null)
    {
        $this->row = $row;
        $this->headers = $headers;
        $this->responsive = $responsive;
        $this->odd = $odd;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.blocks-table-row');
    }
}
