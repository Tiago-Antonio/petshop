<?php

namespace App\Http\Livewire\Components\Header;

use Livewire\Component;

class Header extends Component
{
    public $lista = [];

    

    public function render()
    {
        return view('livewire.components.header.header');
    }
}
