<?php

namespace App\Http\Livewire\Vendas;

use App\Models\User;
use App\Models\Order;
use App\Models\Sale;
use App\Models\OrderItem;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Vendas')]
class Vendas extends Component
{
    use WithPagination;
    public $query;
    public $showProducts;
    public $pagamento = false;
    public $escolhaMetodoPagamento;
    public $order_id;
    

    public function metodoPagamento($id){

        $this->pagamento = true;
        $this->order_id = $id;
               
    }

   public function cancelarVenda($id)
    {
        // 1. Atualiza o status da venda para "cancelado"
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'cancelado',
        ]);

        // 2. Busca todos os itens relacionados a essa venda
        $orderItems = OrderItem::where('order_id', $id)->get();

        // 3. Para cada item, devolve a quantidade ao estoque e remove o item da tabela order_items
        foreach ($orderItems as $item) {
            // Busca o produto relacionado ao item
            $product = Product::find($item->product_id);

            if ($product) {
                // Soma a quantidade devolvida ao estoque
                $product->current_stock += $item->quantity;
                $product->save();
            }

            // Remove o item do pedido
            $item->delete();
        }

        // Opcional: mensagem ou redirecionamento
        session()->flash('message', 'Venda cancelada com sucesso.');
        return redirect()->back();
    }

    public function confirmarPagamento(){  

        $this->validate([
            'escolhaMetodoPagamento' => 'required|in:1,2,3,4',
        ]);

        try{
            $order = Order::find($this->order_id);
            if (!$order) {
                session()->flash('erro', 'Pedido não encontrado.');
                return;
            }

            //Atualizar Pedido com o Metodo de pagamento - payment_id
            $order->update([
                'payment_id'=>$this->escolhaMetodoPagamento,
                'status'=>'finalizado'
            ]);
            
            //Criar uma venda
            Sale::create([
                'order_id'=> $order->id,
            ]);
            
            session()->flash('sucesso', 'Sucesso ao confirmar a venda!');
            $this->reset(['pagamento', 'order_id', 'escolhaMetodoPagamento']);
        } catch(\Exception $e){
            session()->flash('erro', 'Erro ao confirmar a venda!'.$e->getMessage());
        }
        
    }

     public function updatedquery()
    {
        $this->resetPage();
    }

    public function render()
    {   
        $pedidos = Order::with([
                    'client:id,name',
                    'orderitem.product:id,name,sale_price',
                    'sale:id,order_id',
                    'user:id,name',
        ])
        ->orderBy('created_at', 'desc');

        // Filtrar apenas quando existir alguma pesquisa
        if(!empty($this->query)){
            $pedidos->whereHas('client', function ($query) {
                $query->where('name', 'like', '%' . $this->query . '%');
            });
        }
       
        return view('livewire.vendas.vendas', [
            'pedidos' => $pedidos->paginate(5)
        ]);
    }
}
