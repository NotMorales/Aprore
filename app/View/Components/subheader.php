<?php

namespace App\View\Components;

use Illuminate\View\Component;

class subheader extends Component
{
    public $subheaders;
    public $acciones;

    public function __construct($subheaders=[], $acciones=[])
    {
        $this->subheaders = $subheaders;
        $this->acciones = $acciones;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.subheader');
    }
}
