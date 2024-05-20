<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class MultiSelect extends Component
{
    /**
     * @param  array<mixed>  $options
     */
    public function __construct(
        public array $options,
        public string $name,
        public ?array $selected = [],
        public ?string $class = '',
    ) {
        if ($this->selected === null) {
            $this->selected = [];
        }
    }

    public function render(): View
    {
        return view('components.multi-select');
    }
}
