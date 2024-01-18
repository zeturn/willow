<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PatrolButton extends Component
{
    public $color;
    public $route;
    public $text1;
    public $text2;

    /**
     * Create a new component instance.
     */
    public function __construct($color, $route, $text1, $text2)
    {
        $this->color = $color;
        $this->route = $route;
        $this->text1 = $text1;
        $this->text2 = $text2;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.patrol-button');
    }
}
