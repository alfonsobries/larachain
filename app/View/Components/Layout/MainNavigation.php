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
                'route' => 'transactions',
                'label' => 'Transactions',
            ],
            [
                'route' => 'blocks',
                'label' => 'Blocks',
            ],
            [
                'route' => 'wallets',
                'label' => 'Wallets',
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
