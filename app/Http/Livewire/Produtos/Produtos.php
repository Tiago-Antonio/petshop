<?php

namespace App\Http\Livewire\Produtos;

use App\Models\Client;
use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockEntry;
use App\Models\Supplier;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Title('Produtos')]
class Produtos extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Url Query parameters
    #[Url(as: 'q', history:true)]
    public $nomeProduto;

    
    public $query;
    public $show;
    public $dropdownProdutos;
    public $dropdownSupplier;

    // Forms
    public $product_id;
    public $supplier_id;
    public $quantity;
    public $unit_price;
    public $entry_date;

    //Carrinho
    public $carrinho = [];
    public $somaCart = [];
    public $soma = 0;
    public $preco_total;


    public $client_name = false;
    public $client_id;
    public $clientes = [];

    public function clienteForms(){
        $this->client_name = false; 
    }


    public function adicionarCarrinho($product_id)
    {
        //Escolher um cliente
        if (empty($this->client_id)) {

            $this->client_name = true;

            $this->carrinho = [];
        }


        $produto = Product::find($product_id);
        if ($produto) {
            $produtoNoCarrinho = collect($this->carrinho)->firstWhere('id', $product_id);
            if (!$produtoNoCarrinho) {
                $this->carrinho[] = [
                    'id' => $produto->id,
                    'nome' => $produto->name,
                    'preco' => $produto->sale_price,
                    'imagem' => $produto->photo_path,
                    'quantidade' => 1,
                ];
            } else {
                $this->carrinho = collect($this->carrinho)->map(function ($item) use ($product_id) {
                    if ($item['id'] == $product_id) {
                        $item['quantidade'] += 1;
                    }
                    return $item;
                })->toArray();
            }
        } else {
            session()->flash('error', 'Produto não encontrado!');
        }
        

        //Passar a quantidade de produtos no carrinho para o blade
        $this->somaCart = [];
        $this->soma = 0;
        $this->preco_total = 0;
        foreach($this->carrinho as $cart){
            $this->somaCart[$cart['id']] = [
                'quantidade' =>$cart['quantidade'], 
                'preco_total'=>$cart['quantidade'] * $cart['preco'],
            ]; 
            $this->soma += $cart['quantidade'];
            $this->preco_total += $cart['quantidade'] * $cart['preco'];
        }

        
    }   

    public function removerCarrinho($product_id)
    {
        foreach ($this->carrinho as $index => $item) {
            if ($item['id'] == $product_id) {
                if ($item['quantidade'] > 1) {
                    $this->carrinho[$index]['quantidade'] -= 1;
                    $this->soma -= 1;
                } else {
                    unset($this->carrinho[$index]);
                    $this->carrinho = array_values($this->carrinho);
                }
                $this->preco_total -= 1 * $item['preco'];
                break;
            }
        }

        $this->somaCart = [];
        $this->soma = 0;
        $this->preco_total = 0;

        foreach ($this->carrinho as $cart) {
            $this->somaCart[$cart['id']] = [
                'quantidade' => $cart['quantidade'],
                'preco_total' => $cart['quantidade'] * $cart['preco'],
            ];
            $this->soma += $cart['quantidade'];
            $this->preco_total += $cart['quantidade'] * $cart['preco'];
        }
    }


    //Finalizando o pedido - Envia os dados para a tabela Order e OrderItems
    public function finalizarPedido()
    {
        if (Auth::check()) {

            $user_id = Auth::user()->id;

            if (count($this->carrinho) === 0) {
                session()->flash('erroPedido', 'Seu carrinho está vazio!');
                return;
            } else {
                try {

                    //inicia a operacao
                    DB::beginTransaction();

                    //Quantidade do produto não pode ser < 0
                    foreach ($this->carrinho as $produto) {
                        $produto_id = $produto['id'];
                        $quantity = $this->somaCart[$produto_id]['quantidade'] ?? $produto['quantidade'] ?? 1;
                        $produtoEstoque = Product::find($produto_id);
                        
                        
                        if ($produtoEstoque->current_stock < $quantity) {
                            throw new \Exception("Estoque insuficiente para o produto: {$produtoEstoque->name}. Disponível: {$produtoEstoque->current_stock}");
                        }
                    }
                    $pedido = Order::create([
                        'client_id' => $this->client_id,
                        'user_id' => $user_id,                     
                        'status' => 'pendente',
                        'total_amount' => $this->preco_total,
                        //sem o payment_id
                        'data' => now(),
                    ]);

                    foreach ($this->carrinho as $produto) {
                        $produto_id = $produto['id'];
                        $quantity = $this->somaCart[$produto_id]['quantidade'] ?? $produto['quantidade'] ?? 1;
                        //remove a quantidade dos Product para enviar para a tabela OrderItem
                        $removendo_produto = Product::find($produto['id']);
                        $removendo_produto->current_stock -= $quantity;
                        $removendo_produto->save();

                        if($removendo_produto->current_stock <= $removendo_produto->min_stock){
                            session()->flash('estoqueMinimo', "O produto '{$removendo_produto->name}' está abaixo do estoque mínimo!");
                        }

                        OrderItem::create([
                            'order_id' => $pedido->id,
                            'product_id' => $produto['id'],
                            'quantity' => $quantity,
                        ]);
                    }
                    
                    //confirma a operacao
                    DB::commit();

                    $this->carrinho = [];
                    $this->client_id = '';
                    session()->flash('sucessPedido', 'Pedido realizado com sucesso!');
                } catch (\Exception $e) {

                    //reorna a operacao caso de algum erro
                    DB::rollBack();

                    $mensagemErro = $e->getMessage();
                    if (str_contains($mensagemErro, 'Estoque insuficiente')) {
                        session()->flash('erroPedido', $mensagemErro);
                    } else {
                        session()->flash('erroPedido', 'Falha no pedido:'.$e->getMessage());
                    }
                }
            }
        } else {
            return redirect()->route('logout');
        }
    }


    //DropDown para a escolha do Tipo do Produto e Fornecedor
    public function mount()
    {
        $this->dropdownProdutos = Product::orderBy('id')->get();
         $this->dropdownSupplier = Supplier::orderBy('id')->get();
    }



    //Cadastra os produtos na tabela StockEntry vindo de um Supplier e ligando com a tabela product
    public function CadastrarProduto()
    {
        $this->validate([
            'product_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
        ]);

        try {

            StockEntry::create([
                'product_id' => $this->product_id,
                'supplier_id' => $this->supplier_id,
                'quantity' => $this->quantity,
                'unit_price' => $this->unit_price,
                'entry_date' => $this->entry_date ?? now(),
            ]);

            //Atualiza os Dados da tabela Produtos com a entrada dos novos produtos e a média do preço!
            $produto = Product::find($this->product_id);
            $estoqueAntigo = $produto->current_stock;
            $precoAntigo = $produto->purchase_price;
            $novaQuantidade = $this->quantity;
            $novoPreco = $this->unit_price;

            $novoPrecoMedio = (($estoqueAntigo * $precoAntigo) + ($novaQuantidade * $novoPreco)) / ($estoqueAntigo + $novaQuantidade);
            if ($produto) {
                $produto->current_stock += $novaQuantidade;
                $produto->purchase_price = $novoPrecoMedio;
                $produto->sale_price = $novoPrecoMedio * 1.50;
                $produto->save();
            }


            session()->flash('successoCadastrar', 'Produto cadastrado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('erroCadastrar', 'Erro ao cadastrar o produto!');
            dd($e->getMessage());
        }

        $this->resetarCampos();
        $this->show = false;
    }



    public function abrirModalProduto()
    {
        $this->show = true;
    }

    public function fecharModalProduto()
    {
        $this->resetarCampos();
        $this->show = false;
    }


    public function updatednomeProduto()
    {
        $this->resetpage();
    }
    public function resetarCampos()
    {
        $this->reset(['quantity', 'unit_price', 'entry_date', 'product_id', 'supplier_id']);
    }

    public function cancelarSecao(){
        $this->client_name = false;
        $this->client_id = '';
    }

    public function nextPage()
    {
        $pageName = 'page';
        $paginaAtual = $this->getPage($pageName);

        $ultimaPagina = Product::where('name', 'like', '%' . $this->nomeProduto . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(8)
                            ->lastPage();

        if ($paginaAtual < $ultimaPagina) {
            $this->setPage($paginaAtual + 1, $pageName);
        }
    }

    public function render()
    {
        $this->clientes = Client::all();
        $query = Product::query();

        if (!empty($this->nomeProduto)) {
            $query = Product::where('name', 'like', '%' . $this->nomeProduto . '%');
        }

        $produtos = $query->orderBy('created_at', 'asc')
        ->paginate(8);

        return view('livewire.produtos.produtos', [
            'produtos' => $produtos, 
            'lastPage' => $produtos->lastPage(),
        ]);
    }
}
