<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class MainNavigation extends Component
{
    public $menuItems = [];

    /**
     * Create a new component instance.
     *
     * @param array $menuItems
     * @return void
     */
    public function __construct()
    {
        $this->menuItems = [
            [
                'route' => 'welcome',
                'label' => 'Explorer',
            ],
            [
                'href' => '',
                'label' => 'About',
            ],
            [
                'icon' => <<<HTML
    <svg fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5 mr-4">
        <path
            d="M7.975 16a9.39 9.39 0 003.169-.509c-.473.076-.652-.229-.652-.486l.004-.572c.003-.521.01-1.3.01-2.197 0-.944-.316-1.549-.68-1.863 2.24-.252 4.594-1.108 4.594-4.973 0-1.108-.39-2.002-1.032-2.707.1-.251.453-1.284-.1-2.668 0 0-.844-.277-2.77 1.032A9.345 9.345 0 008 .717c-.856 0-1.712.113-2.518.34C3.556-.24 2.712.025 2.712.025c-.553 1.384-.2 2.417-.1 2.668-.642.705-1.033 1.612-1.033 2.707 0 3.852 2.342 4.72 4.583 4.973-.29.252-.554.692-.642 1.347-.58.264-2.027.692-2.933-.831-.19-.302-.756-1.045-1.549-1.032-.843.012-.34.478.013.667.428.239.919 1.133 1.032 1.422.201.567.856 1.65 3.386 1.184 0 .55.006 1.079.01 1.447l.003.428c0 .265-.189.567-.692.479 1.007.34 1.926.516 3.185.516z">
        </path>
    </svg>
    HTML,
                'href' => '#',
                'label' => 'Source',
            ],
        ];
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.layout.main-navigation');
    }
}
