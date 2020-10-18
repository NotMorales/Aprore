<?php

namespace App\View\Components;

use Illuminate\View\Component;

class noticia extends Component {
    public $svg;

    public function __construct($svg="") {
        $this->svg = $svg;
    }

    public function render() {
        return view('components.noticia');
    }
}
