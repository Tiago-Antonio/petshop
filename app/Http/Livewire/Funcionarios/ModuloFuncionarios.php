<?php

namespace App\Http\Livewire\Funcionarios;

use App\Models\Order;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Spatie\Browsershot\Browsershot;

#[Title('Funcionários')]
class ModuloFuncionarios extends Component
{
    use WithPagination;

    public $nomeFuncionario = '';
    public $perPage = 8; 
    public $nome;
    public $data_nascimento;
    public $cargo;
    public $email;
    public $telefone;
    public $path_foto;
    public $password;
    public $funcionarioId = null; 
    public $confirmando = null;

    public $show = false;
    public $abrirOpcoes = false;
    public $modalAbertoParaId = null;

    public function gerarRelatorioPDF()
    {
        try {
            $funcionarios = User::all();

            $html = view('pdf.funcionarios', compact('funcionarios'))->render();

            $fileName = 'funcionarios.pdf';

            Browsershot::html($html)
                ->setOption('args', ['--no-sandbox'])
                ->save(storage_path("app/public/{$fileName}"));

            return response()->download(storage_path("app/public/{$fileName}"));

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao gerar o PDF: ' . $e->getMessage());
        }
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
        
        $this->show = true;
        $this->modalAbertoParaId = false;

    }


    public function rules(){
        return [
            'nome'=>'required',
            'email'=>'required',
            'password'=>'required',
            'telefone'=>'max:11|min:11',
        ];
    }

    protected function rulesUpdate()
    {
        return [
            'telefone' => 'nullable|min:11|max:11',
        ];
    }

    public function confirmarExclusao($id)
    {
        $this->confirmando = $this->confirmando === $id ? null : $id;
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
        $this->modalAbertoParaId = false;
        $this->confirmando = false;
    }

    public function CadastrarFuncionario()
    {

        if (!$this->funcionarioId) {
            $this->validate(); 
        }

        $this->validate($this->rulesUpdate());
        try {
            if ($this->funcionarioId) {
                // Atualizar funcionário
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

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar funcionário.');
        }
    }


    public function buscar()
    {
        $this->nomeFuncionario = $this->nomeFuncionario;
    }
    
    public function resetarCampos()
    {
        $this->reset(['nome', 'email', 'telefone', 'cargo', 'data_nascimento', 'path_foto', 'password', 'funcionarioId']);
    }

     public function updatednomeFuncionario()
    {
       $this->resetPage();
    }

    public function abrirModalOpcoes($id){

        if ($this->modalAbertoParaId === $id) {
        $this->modalAbertoParaId = null;
        } else {
            $this->modalAbertoParaId = $id;
        }

        
    }
     public function abrirModal()
    {
        $this->show = true;
    }

      public function fecharModal()
    {
        $this->resetErrorBag();
        $this->resetarCampos();
        $this->funcionarioId = null;
        $this->show = false; 
           
    }
  

    public function render()
    {
        $funcionarios = User::withCount('order')
            ->where('name', 'like', '%' . $this->nomeFuncionario . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        $funcionarios_pedidos = User::withCount([
                'order',
                'order as completed_orders_count' => function ($query) {
                    $query->where('status', 'finalizado');
                }
            ])
            ->whereHas('order')
            ->orderByDesc('order_count') 
            ->take(10) 
            ->get();

        return view('livewire.funcionarios.modulofuncionarios', [
            'funcionarios' => $funcionarios,
            'funcionarios_pedidos' => $funcionarios_pedidos,
        ]);
    }



}
