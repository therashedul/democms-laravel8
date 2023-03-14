<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $type;
    public $name;
    public $title;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $class)
    {
        $this->type=$type;
        $this->name=$name;
        $this->class=$class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
