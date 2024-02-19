<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Layout
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name='',
    )
    {
        parent::__construct($name);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout');
    }
}
