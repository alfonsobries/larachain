<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\View\Components\Traits\HasVariants;

class Button extends Component
{
    use HasVariants;

    /**
     * The type of the button
     *
     * @var string
     */
    public string $type;

    /**
     * The href attribute
     *
     * @var string|null
     */
    public $href;

    /**
     * Classes that all the variants has in common
     * 
     * @var string
     */
    protected $fixedClasses = 'transition duration-150 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed';
    
    /**
     * Classes for default if no variant set
     * 
     * @var string
     */
    protected $defaultClasses = 'px-6 py-3 text-center text-sm leading-none text-white bg-gray-800 border border-transparent rounded-md focus:border-gray-600 focus:outline-none focus:shadow-outline-gray hover:bg-gray-600 dark:bg-gray-800';
    
    /**
     * List of possible variants
     * 
     * @var array
     */
    protected $variants = [
        'secondary' => 'px-6 py-3 text-center text-sm leading-none text-gray-500 border border-gray-200 dark:border-gray-700 rounded-md hover:border-gray-800 hover:text-gray-800 dark:hover:text-gray-600 focus:border-gray-800 focus:text-gray-800 focus:outline-none focus:shadow-outline-gray'
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'button', $variant = null, $href = null)
    {
        $this->type = $type;
        
        $this->href = $href;
        
        $this->makeClasses($variant);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
