<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Client;
use App\Models\User;

class Clientes extends Component
{
    public $cliente;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $query = [];
    public $confirmando = false;

    public function excluirCliente($id)
    {
        $cliente = Client::find($id);
        
        if ($cliente) {
            $cliente->delete();
            session()->flash('message', 'Cliente excluído com sucesso.'); 
        } else {
            session()->flash('error', 'Cliente não encontrado.');  
        }
    
        $this->confirmando = false;
    }
    

    public function render()
    {
        $this->query = Client::all();

        return view('livewire.clientes.clientes');
    }
}
