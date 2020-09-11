<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class InputGroup extends Component
{
    /**
     * The label text.
     *
     * @var string
     */
    public string $label;
    
    /**
     * 
     * The for attribute for the label
     *
     * @var string
     */
    public string $for;

    /**
     * Create the component instance.
     *
     * @param  string  $label
     * @return void
     */
    public function __construct($label = '', $for = '')
    {
        $this->label = $label;
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.input-group');
    }
}
