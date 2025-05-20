<?php

namespace App\Http\Livewire\Vendas;

use App\Models\User;
use App\Models\Order;
use App\Models\Sale;
use App\Models\OrderItem;
use App\Models\Client;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Vendas')]
class Vendas extends Component
{
    use WithPagination;
    public $query;
    public $showProducts;
    
    public function confirmarVenda($id){
        try{
            $venda = Order::find($id);
            if (!$venda) {
                session()->flash('erro', 'Pedido não encontrado.');
                return;
            }

            Sale::create([
                'order_id'=> $venda->id,
            ]);

            $venda->status = 'Finalizado';
            $venda->save();

            session()->flash('sucesso', 'Sucesso ao confirmar a venda!');
        } catch(\Exception $e){
            session()->flash('erro', 'Erro ao confirmar a venda!');
        }
    }

    public function render()
    {   
        $pedidos = Order::with([
                    'client:id,name',
                    'orderitem.product:id,name',
                    'sale:id,order_id',
                    'user:id,name',
        ]);

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
