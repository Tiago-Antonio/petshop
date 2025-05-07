<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Client;
use App\Models\User;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;
    public $cliente;
    public $nome;
    public $email;
    public $telefone;
    public $endereco;
    public $foto;
    public $query = [];
    public $confirmando = false;
    public $clienteId = null; 
    public $clientesPaginados;
    public $nome_cliente = '';
    public $show = false;
    public $perPage = 6; 


    public function CadastrarCliente()
    {
        try {
            if ($this->clienteId) {
                $cliente = Client::findOrFail($this->clienteId);

                $cliente->update([
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'address' => $this->endereco,
                    'photo_path' => $this->foto,
                ]);

                session()->flash('success', 'Cliente atualizado com sucesso!');
            } else {
                Client::create([
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'address' => $this->endereco,
                    'photo_path' => $this->foto,
                   
                ]);

                session()->flash('success', 'Cliente cadastrado com sucesso!');
            }

            $this->resetarCampos();

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar cliente.');
            dd($e->getMessage());
        }
    }


    public function editarCliente($id)
    {
        $cliente = Client::findOrFail($id);

        $this->clienteId = $id;
        $this->nome = $cliente->name;
        $this->email = $cliente->email;
        $this->telefone = $cliente->phone;
        $this->foto = $cliente->photo_path;
        $this->endereco = $cliente->address;
    
    }

    public function updatingPage()
    {
        $this->resetarCampos();
    }


    public function resetarCampos()
    {
        $this->clienteId = null;
        $this->nome = '';
        $this->email = '';
        $this->telefone = '';
        $this->endereco = '';
        $this->foto = '';
        $this->show = false;
        $this->resetErrorBag();
    }

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
        $query = Client::query();

        if (!empty($this->nome_cliente)) {
            $query->where('name', 'like', '%' . $this->nome_cliente . '%');
        }

        $clientesPaginados = $query->paginate($this->perPage);

        return view('livewire.clientes.clientes', [
            'clientes' => $clientesPaginados
        ]);
    }
}
