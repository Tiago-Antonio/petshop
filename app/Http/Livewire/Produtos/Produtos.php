<?php

namespace App\Http\Livewire\Produtos;

use Livewire\Component;
use App\Models\Product;
use App\Models\StockEntry;
use Livewire\WithPagination;
use Livewire\WithFileUploads;



class Produtos extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $nomeProduto;
    public $query;
    public $show;
    public $dropdownProdutos;

    // Forms
    public $product_id;
    public $quantity;
    public $unit_price;
    public $entry_date;
    
    


    public function mount(){
        $this->dropdownProdutos = Product::orderBy('id')->get();
    }

    public function CadastrarProduto(){  
        $this->validate([
            'product_id'=>'required',
            'quantity'=>'required',
            'unit_price'=>'required',
        ]);

        
        try{
            
            StockEntry::create([
                'product_id' => $this->product_id,
                'supplier_id' => 1,
                'quantity' => $this->quantity,
                'unit_price' => $this->unit_price,
                'entry_date' => $this->entry_date ?? now(),
            ]);

            //Atualiza os Dados da tabela Produtos com a entrada dos novos produtos!
             $produto = Product::find($this->product_id);
            if ($produto) {
                $produto->current_stock += $this->quantity;
                $produto->save();
            }
            

            session()->flash('successoCadastrar', 'Produto cadastrado com sucesso!');


        } catch(\Exception $e){
            session()->flash('erroCadastrar', 'Erro ao cadastrar o produto!');
            dd($e->getMessage()); 
        }

        $this->resetarCampos();
        $this->show = false;
    }

    public function abrirModalProduto(){
        $this->show = true;
    }

    public function fecharModalProduto(){
        $this->show = false;
    }
    

    public function updatednomeProduto(){
        $this->resetpage();
    }
    public function resetarCampos()
    {
        $this->reset(['quantity', 'unit_price', 'entry_date', 'product_id']);
    }


    public function render()
    {
        $query = Product::query();

        if(!empty($this->nomeProduto)){
            $query = Product::where('name', 'like', '%' . $this->nomeProduto . '%');
        }

        $produtos = $query->paginate(8);
        
        return view('livewire.produtos.produtos', ['produtos' => $produtos]);
    }
}
