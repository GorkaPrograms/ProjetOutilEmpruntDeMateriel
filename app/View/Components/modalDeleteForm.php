<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalDeleteForm extends AbstractLayout
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name='',
        public string $action='')
    {
        parent::__construct($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-delete-form');
    }
}
