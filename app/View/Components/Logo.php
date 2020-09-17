<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Logo extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
<a href="{{ route('welcome') }}" {{ $attributes->merge(['class' => 'inline-flex items-center flex-shrink-0']) }}>
    <img class="w-auto h-8 lg:block"
        src="/images/logo.svg" alt="Larachain">
    <span class="ml-4 text-2xl text-gray-700 dark:text-gray-300">Larachain</span>
</a>
blade;
    }
}
