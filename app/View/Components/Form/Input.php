<?php

namespace App\View\Components\Form;

use App\View\Components\Traits\HasVariants;
use Illuminate\View\Component;

class Input extends Component
{
    use HasVariants;

    /**
     * Classes that all the variants has in common
     * 
     * @var string
     */
    protected $fixedClasses = 'form-input block w-full disabled:opacity-50 disabled:cursor-not-allowed';
    
    /**
     * Classes for default if no variant set
     * 
     * @var string
     */
    protected $defaultClasses = 'p-3 text-gray-800 bg-white dark:bg-gray-700 dark:border-gray-800 dark:text-gray-200';
    
    /**
     * List of possible variants
     * 
     * @var array
     */
    protected $variants = [
        'error' => 'p-3 bg-red-100 text-red-500 border-red-500'
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($variant = null)
    {
        $this->makeClasses($variant);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
