<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Client;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Clientes extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $cliente;
    public $nome;
    public $email;
    public $telefone;
    public $imagemAtual;
    public $endereco;
    public $photo_path;
    public $query = [];
    public $confirmando = false;
    public $clienteId = null;
    public $clientesPaginados;
    public $show = false;
    public $perPage = 6;

    public $nomeCliente;
    // Buscar


    public function rules(){
        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'endereco' => 'required|string',
            'photo_path' => 'nullable|image|max:2048',
        ];
    }

    public function CadastrarCliente()
    {
        $validated = $this->validate();

        try {
            if ($this->clienteId) {
                $cliente = Client::findOrFail($this->clienteId);

                // Atualiza os dados
                $dados = [
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'address' => $this->endereco,
                ];


                if ($this->photo_path) {

                    if ($cliente->photo_path) {
                        Storage::disk('public')->delete($cliente->photo_path);
                    }
                    $dados['photo_path'] = $this->photo_path->store('clientes', 'public');
                }
                $cliente->update($dados);

                session()->flash('success', 'Cliente atualizado com sucesso!');
            } else {
                // Novo Cadastro
                $dados = [
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'address' => $this->endereco,
                ];

                if ($this->photo_path) {
                    $dados['photo_path'] = $this->photo_path->store('clientes', 'public');
                }

                Client::create($dados);

                session()->flash('success', 'Cliente cadastrado com sucesso!');
            }

            $this->resetarCampos();
            
        } catch (\Exception $e) {

            session()->flash('error', 'Erro ao salvar cliente.');
            
        }
    }


    public function editarCliente($id)
    {
        $cliente = Client::findOrFail($id);

        $this->clienteId = $id;
        $this->nome = $cliente->name;
        $this->email = $cliente->email;
        $this->telefone = $cliente->phone;
        $this->imagemAtual = $cliente->photo_path;
        $this->photo_path = null;

        $this->endereco = $cliente->address;
        $this->show = true;
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
        $this->photo_path = '';
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

    public function abrirModelAdicionar()
    {
        $this->show = true;
    }
    public function fecharModelAdicionar()
    {
        $this->resetarCampos();
    }

    public function updatednomeCliente()
    {
        $this->resetPage();
    }


    public function render()
    {

        $query = Client::query();

        if (!empty($this->nomeCliente)) {
            $query->where('name', 'like', '%' . $this->nomeCliente . '%');
        }

        $clientesPaginados = $query->paginate(5);

        return view('livewire.clientes.clientes', [
            'clientes' => $clientesPaginados
        ]);
    }
}
