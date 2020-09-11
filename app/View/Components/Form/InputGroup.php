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
     * 
     * An optional error message
     *
     * @var string
     */
    public string $error;

    /**
     * Create the component instance.
     *
     * @param  string  $label
     * @return void
     */
    public function __construct($label = '', $for = '', $error = '')
    {
        $this->label = $label;
        $this->for = $for;
        $this->error = $error;
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
