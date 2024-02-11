<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select extends Component
{
    /**
     * @param array<mixed> $options
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
