<?php

namespace App\Http\Livewire\Funcionarios;

use Livewire\Component;
use App\Models\Funcionario;
use Livewire\WithPagination;

class ModuloFuncionarios extends Component
{
    use WithPagination;

    public $nome_funcionario = '';
    public $perPage = 8; 
    public $nome;
    public $data_nascimento;
    public $cargo;
    public $email;
    public $telefone;
    public $path_foto;
    public $password;
    public $funcionarioId = null; 


    public $show = false;
    public $showOpcoes = false;

    public function abrirModal()
    {
        $this->resetarCampos();
        $this->funcionarioId = null;
        $this->show = !$this->show;
    }

    public function editarFuncionario($id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $this->funcionarioId = $id;
        $this->nome = $funcionario->nome;
        $this->email = $funcionario->email;
        $this->telefone = $funcionario->telefone;
        $this->cargo = $funcionario->cargo;
        $this->data_nascimento = $funcionario->data_nascimento;
        $this->path_foto = $funcionario->path_foto;
        $this->password = ''; 

        $this->show = true;
    }

    public function fecharModal()
    {
        $this->show = false;
    }

    public function CadastrarFuncionario()
    {
        try {
            if ($this->funcionarioId) {
                $funcionario = Funcionario::findOrFail($this->funcionarioId);

                $funcionario->update([
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'telefone' => $this->telefone,
                    'cargo' => $this->cargo,
                    'data_nascimento' => $this->data_nascimento,
                    'path_foto' => $this->path_foto,
                    'password' => $this->password ? bcrypt($this->password) : $funcionario->password,
                ]);

                session()->flash('success', 'Funcionário atualizado com sucesso!');
            } else {
                Funcionario::create([
                    'nome' => $this->nome,
                    'email' => $this->email,
                    'telefone' => $this->telefone,
                    'cargo' => $this->cargo,
                    'data_nascimento' => $this->data_nascimento,
                    'path_foto' => $this->path_foto,
                    'password' => bcrypt($this->password),
                ]);

                session()->flash('success', 'Funcionário cadastrado com sucesso!');
            }

            $this->fecharModal();
            $this->resetarCampos();

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar funcionário.');
            dd($e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false; 
        session()->forget('success'); 
        session()->forget('error'); 
    }

    public function excluirFuncionario($id)
    {
        $funcionario = Funcionario::find($id);
    
        if ($funcionario) {
            $funcionario->delete();
            session()->flash('message', 'Funcionário excluído com sucesso.');
        } else {
            session()->flash('error', 'Funcionário não encontrado.');
        }
        $this->confirmando = false;
    }
    
    public function buscar()
    {
        $this->nome_funcionario = $this->nome_funcionario;
    }
    
    public function resetarCampos()
    {
        $this->reset(['nome', 'email', 'telefone', 'cargo', 'data_nascimento', 'path_foto', 'funcionarioId']);
    }

  

    public function render()
    {
        $funcionarios = Funcionario::where('nome', 'like', '%' . $this->nome_funcionario . '%')->paginate($this->perPage); 
        
        return view('livewire.funcionarios.modulofuncionarios', ['funcionarios' => $funcionarios,]);
    }
}
