<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public array $options,
        public string $name,
        public ?string $selected = '',
        public ?string $class = '',
    ) {
    }

    public function render(): View
    {
        return view('components.select');
    }
}
