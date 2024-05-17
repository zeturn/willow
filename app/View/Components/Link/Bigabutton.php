<?php

namespace App\View\Components\Link;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Bigabutton extends Component
{
    /**
     * Create a new component instance.
     */
    public $url;
    public $class;

    public function __construct($url,$class = '')
    {
        $this->url =$url;
        $this->class =$class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link.bigabutton');
    }
}
