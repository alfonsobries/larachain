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
    protected $fixedClasses = 'transition duration-150 ease-in-out';
    
    /**
     * Classes for default if no variant set
     * 
     * @var string
     */
    protected $defaultClasses = 'px-6 py-3 text-center text-sm leading-none text-white bg-gray-900 border border-transparent rounded-md focus:border-gray-600 focus:outline-none focus:shadow-outline-gray hover:bg-gray-600';
    
    /**
     * List of possible variants
     * 
     * @var array
     */
    protected $variants = [
        'secondary' => 'px-6 py-3 text-center text-sm leading-none text-gray-500 bg-white border border-gray-200 rounded-md hover:border-gray-900 hover:text-gray-900 focus:border-gray-900 focus:text-gray-900 focus:outline-none focus:shadow-outline-gray'
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
