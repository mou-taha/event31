<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFlatpickr extends Component
{
    public $disabled;
    public function __construct($disabled = false)
    {
        $this->disabled = $disabled;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-flatpickr');
    }
}
