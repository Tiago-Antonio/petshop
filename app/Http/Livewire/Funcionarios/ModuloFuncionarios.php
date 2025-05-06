<?php

namespace App\Http\Livewire\Funcionarios;

use Livewire\Component;
use App\Models\User;
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
    public $confirmando = false;

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
      
        $funcionario = User::findOrFail($id);

        $this->funcionarioId = $id;
        $this->nome = $funcionario->name;
        $this->email = $funcionario->email;
        $this->telefone = $funcionario->phone;
        $this->cargo = $funcionario->role;
        $this->data_nascimento = $funcionario->birth_date;
        $this->path_foto = $funcionario->photo_path;
        $this->password = '';
    
    }

    

    public function CadastrarFuncionario()
    {
        try {
            if ($this->funcionarioId) {
                $funcionario = User::findOrFail($this->funcionarioId);

                $funcionario->update([
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'role' => $this->cargo,
                    'birth_date' => $this->data_nascimento,
                    'photo_path' => $this->path_foto,
                    'password' => $this->password ? bcrypt($this->password) : $funcionario->password,
                ]);

                session()->flash('success', 'Funcionário atualizado com sucesso!');
            } else {
                User::create([
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'role' => $this->cargo,
                    'birth_date' => $this->data_nascimento,
                    'photo_path' => $this->path_foto,
                    'password' => bcrypt($this->password),
                ]);

                session()->flash('success', 'Funcionário cadastrado com sucesso!');
            }

            $this->resetarCampos();

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar funcionário.');
            dd($e->getMessage());
        }
    }


    public function excluirFuncionario($id)
    {
        $funcionario = User::find($id);
        
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
        $this->reset(['nome', 'email', 'telefone', 'cargo', 'data_nascimento', 'path_foto', 'password']);
    }

  

    public function render()
    {
        $funcionarios = User::where('name', 'like', '%' . $this->nome_funcionario . '%')->paginate($this->perPage); 
        
        return view('livewire.funcionarios.modulofuncionarios', ['funcionarios' => $funcionarios,]);
    }
}
