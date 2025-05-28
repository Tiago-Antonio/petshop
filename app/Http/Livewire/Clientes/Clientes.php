<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;

#[Title('Clientes')]
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
            'nome' => 'required|string',
            'email' => 'required|email',
            'telefone' => 'required|string|max:11|min:6',
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

        try{
            if ($cliente) {
                $cliente->delete();
                session()->flash('message', 'Cliente excluído com sucesso.');
            }
        }catch(QueryException $e){
            if ($e->getCode() == '23000') {
            session()->flash('erro', 'Não é possível deletar o cliente porque existem pedidos relacionados a ele.');
            } else {
                // Para outras exceções, exibe uma mensagem genérica
                session()->flash('erro', 'Erro ao deletar cliente.');
            }
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro inesperado ao deletar cliente.');
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

    public function nextPage()
    {
        $pageName = 'page';
        $paginaAtual = $this->getPage($pageName);

        $ultimaPagina = Client::where('name', 'like', '%' . $this->nomeCliente . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(5)
                            ->lastPage();

        if ($paginaAtual < $ultimaPagina) {
            $this->setPage($paginaAtual + 1, $pageName);
        }
    }

    public function render()
    {

        $query = Client::query()
        ->orderBy('created_at', 'desc');

        if (!empty($this->nomeCliente)) {
            $query->where('name', 'like', '%' . $this->nomeCliente . '%');
        }

        $clientesPaginados = $query->paginate(5);

        return view('livewire.clientes.clientes', [
            'clientes' => $clientesPaginados,
            'lastPage' => $clientesPaginados->lastPage(),
        ]);
    }
}
