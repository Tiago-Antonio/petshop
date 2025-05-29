<?php

namespace App\Http\Livewire\Produtos;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

#[Title('Categorias')]
class CategoriasProdutos extends Component
{
    
    use WithPagination;
    use WithFileUploads;


    public $produto;
    public $produtoId;
    public $name;
    public $description;
    public $min_stock;
    public $photo_path;
    public $query = [];
    public $confirmando = false;
    public $show = false;
    public $imagemAtual;
    
    // Url Query parameters
    #[Url(as: 'q', history:true)]
    public $nomeProduto;

    public function updatednomeProduto()
    {
       $this->resetPage();
    }

    public function excluirProduto($id)
    {
        $produto = Product::find($id);
        
        try{
            if ($produto) {
                $produto->delete();
                session()->flash('sucesso', 'produto excluído com sucesso.');
            }
        }catch(QueryException $e){
            if ($e->getCode() == '23000') {
            session()->flash('erro', 'Não é possível deletar o produto porque existem pedidos relacionados a ele.');
            } else {
                session()->flash('erro', 'Erro ao deletar produto.');
            }
        } catch (\Exception $e) {
            session()->flash('erro', 'Erro inesperado ao deletar produto.');
        }
        $this->confirmando = false;
    }



     public function editarProduto($id)
    {
        $produto = Product::findOrFail($id);

        $this->produtoId = $id;
        $this->name = $produto->name;
        $this->description = $produto->description;
        $this->min_stock = $produto->min_stock;
        $this->photo_path = null;
        $this->imagemAtual = $produto->photo_path;

        $this->show = true;
    }

    public function updatingPage()
    {
        $this->resetarCampos();
    }

    public function resetarCampos(){
        $this->produtoId = null;
        $this->reset(['name', 'description', 'min_stock', 'photo_path']);
    }

    


    public function cadastrarProduto(){

        try{

            if ($this->produtoId){
                
                $produto = Product::findOrFail($this->produtoId);
                
                // Atualiza os dados
                $dados = [
                    'name'=>$this->name,
                    'description'=>$this->description,
                    'min_stock'=>$this->min_stock,
                    'photo_path' => $produto->photo_path,
                ];
                
                
                if ($this->photo_path) {
                    if ($produto->photo_path) {
                        Storage::disk('public')->delete($produto->photo_path);
                    }

                    $dados['photo_path'] = $this->photo_path->store('produtos', 'public');
                }
                $produto->update($dados);
                session()->flash('success', 'Produtos atualizado com sucesso!');

                $this->fecharModelAdicionar();

            } else{

                $dados = [
                    'name'=>$this->name,
                    'description'=>$this->description,
                    'min_stock'=>$this->min_stock,
                    'photo_path'=>$this->photo_path,
                ];
    
                if ($this->photo_path) {
                        $dados['photo_path'] = $this->photo_path->store('produtos', 'public');
                }
    
                Product::create($dados);
    
                session()->flash('sucesso', 'Sucesso ao salvar categoria');
                $this->fecharModelAdicionar();
            }


        } catch(\Exception $e){
            session()->flash('erro', 'erro ao salvar categoria: '. $e->getMessage());
        }
    }

    public function fecharModelAdicionar(){
        $this->resetarCampos();
        $this->show = false;
    }

    public function nextPage()
    {
        $pageName = 'page';
        $paginaAtual = $this->getPage($pageName);

        $ultimaPagina = Product::where('name', 'like', '%' . $this->nomeProduto . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(5)
                            ->lastPage();

        if ($paginaAtual < $ultimaPagina) {
            $this->setPage($paginaAtual + 1, $pageName);
        }
    }

    public function render()
    {
         $query = Product::query()
        ->orderBy('created_at', 'desc');

        if (!empty($this->nomeProduto)) {
            $query->where('name', 'like', '%' . $this->nomeProduto . '%');
        }

        $produtos = $query->paginate(5);

        return view('livewire.produtos.categorias-produtos', [
            'produtos' => $produtos,
            'lastPage' => $produtos->lastPage(),
        ]);
    }
}
