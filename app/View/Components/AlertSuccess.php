<?php

namespace App\View\Components;

class AlertSuccess extends Alert
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert-success');
    }
}
