<?php

namespace App\View\Components\Traits;

use Illuminate\Support\Arr;

trait HasVariants
{
    /**
     * The classes to render.
     *
     * @var string
     */
    public string $classes;

    /**
     * Merges the fixes classes with the variant classes.
     *
     * @param string|null $variant
     * @return void
     */
    public function makeClasses($variant = null)
    {
        if (property_exists($this, 'fixedClasses')) {
            $classes[] = $this->fixedClasses;
        }

        if ($variant) {
            if (property_exists($this, 'variants')) {
                $classes[] = Arr::get($this->variants, $variant, '');
            }
        } elseif (property_exists($this, 'defaultClasses')) {
            $classes[] = $this->defaultClasses;
        }

        $this->classes = implode(' ', $classes);
    }
}
