<?php

namespace App\Http\Livewire\Components\Header;

use Livewire\Component;

class Header extends Component
{
    public $lista = [];

    

    public function render()
    {
        $this->lista = ['uva','maçã','pera', 'choco'];
        return view('livewire.components.header.header');
    }
}
