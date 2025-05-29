<?php

namespace App\Http\Livewire\Funcionarios;

use App\Models\Order;
use Livewire\Component;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Spatie\Browsershot\Browsershot;

#[Title('Funcionários')]
class ModuloFuncionarios extends Component
{
    use WithPagination;
    use WithFileUploads;

    //Url Query parameters
    #[Url(as: 'q', history:true)]
    public $nomeFuncionario = '';


    public $perPage = 8; 
    public $nome;
    public $data_nascimento;
    public $cargo;
    public $email;
    public $telefone;
    public $photo_path;
    public $imagemAtual;
    public $password;
    public $password_confirmation;
    public $funcionarioId = null; 
    public $confirmando = null;

    public $show = false;
    public $abrirOpcoes = false;
    public $modalAbertoParaId = null;
    public $showChart = false;

    public $ultimaPagina;
    public $usuarios;


  


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
        $this->imagemAtual = $funcionario->photo_path;
        $this->photo_path = null;
        $this->password = '';
        
        
        $this->show = true;
        $this->modalAbertoParaId = false;

    }


    public function rules(){
        return [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->funcionarioId,
            'password' => 'required|string|min:8|max:255|confirmed',
            'telefone' => 'required|string|size:11|regex:/^[0-9]+$/',
            'photo_path'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ];
    }
    protected function messages()
    {
        return [
            'photo_path.image' => 'A imagem deve ser um arquivo de imagem.',
            'photo_path.mimes' => 'A imagem deve ser do tipo jpg, jpeg, png ou webp.',
            'photo_path.max' => 'A imagem não pode ter mais que 2MB.',
        ];
    }

    protected function rulesUpdate()
    {
        return [
            'telefone' => 'nullable|min:11|max:11',
            'password' => 'nullable|string|min:8|max:255|confirmed',
        ];
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
                $dados =[
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'role' => $this->cargo,
                    'birth_date' => $this->data_nascimento,
                    'password' => $this->password ? bcrypt($this->password) : $funcionario->password,
                ];

                if ($this->photo_path) {

                    if ($funcionario->photo_path) {
                        Storage::disk('public')->delete($funcionario->photo_path);
                    }
                    $dados['photo_path'] = $this->photo_path->store('funcionarios', 'public');
                }

                $funcionario->update($dados);



                $this->show = false;
                $this->resetarCampos();
                session()->flash('success', 'Funcionário atualizado com sucesso!');

            } else {
                //Criar Funcionário
                
                $dados = [
                    'name' => $this->nome,
                    'email' => $this->email,
                    'phone' => $this->telefone,
                    'role' => $this->cargo,
                    'birth_date' => $this->data_nascimento,
                    'password' => bcrypt($this->password),
                ];

                if ($this->photo_path) {
                    $dados['photo_path'] = $this->photo_path->store('funcionarios', 'public');
                }

                User::create($dados);

                session()->flash('success', 'Funcionário cadastrado com sucesso!');
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao salvar funcionário.');
        }
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

    


    public function buscar()
    {
        $this->nomeFuncionario = $this->nomeFuncionario;
    }
    
    public function resetarCampos()
    {
        $this->reset(['nome', 'email', 'telefone', 'cargo', 'data_nascimento', 'photo_path', 'password', 'funcionarioId']);
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
  
    public function nextPage()
    {
        $pageName = 'page';
        $paginaAtual = $this->getPage($pageName);

        $ultimaPagina = User::where('name', 'like', '%' . $this->nomeFuncionario . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(8)
                            ->lastPage();

        if ($paginaAtual < $ultimaPagina) {
            $this->setPage($paginaAtual + 1, $pageName);
        }
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
            'lastPage' => $funcionarios->lastPage(),
        ]);
    }



}
