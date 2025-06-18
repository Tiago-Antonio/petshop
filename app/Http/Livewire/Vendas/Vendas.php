<?php

namespace App\Http\Livewire\Vendas;

use App\Models\User;
use App\Models\Order;
use App\Models\Sale;
use App\Models\OrderItem;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Barryvdh\DomPDF\Facade\Pdf;

#[Title('Vendas')]
class Vendas extends Component
{
    use WithPagination;
    // Url Query parameters
    #[Url(as: 'q', history:true)]
    public $query;
    public $showProducts;
    public $pagamento = false;
    public $escolhaMetodoPagamento;
    public $order_id;
    public $confirmando = null;

    public $perPage = 5;

    public function metodoPagamento($id){

        $this->pagamento = true;
        $this->order_id = $id;
               
    }

    public function modalCancelarVenda($id){
        $this->confirmando = $this->confirmando === $id ? null : $id;
    }

   public function cancelarVenda($id)
    {
        if (Auth::check() && Auth::user()->admin == 1){
             $order = Order::findOrFail($id);
            $order->update([
                'status' => 'cancelado',
            ]);

            $orderItems = OrderItem::where('order_id', $id)->get();

            foreach ($orderItems as $item) {
                Product::where('id', $item->product_id)
                ->increment('current_stock', $item->quantity);

                $item->update([
                    'snapshot_quantity' => $item->quantity,
                    'quantity' => 0 
                ]);
            }
            session()->flash('sucesso', 'Venda cancelada com sucesso.');
            $this->confirmando = false;
        } else{
            session()->flash('erro', 'Apenas administradores podem cancelar uma venda!');
            $this->confirmando = false;
        }  
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
            
            session()->flash('sucesso', 'Venda confirmada!');
            $this->reset(['pagamento', 'order_id', 'escolhaMetodoPagamento']);
        } catch(\Exception $e){
            session()->flash('erro', 'Erro ao confirmar a venda!'.$e->getMessage());
        }        
    }

    public function updatedquery()
    {
        $this->resetPage();
    }


    public function gerarPdfVenda()
    {
        try {
            $orders = Order::with(['client', 'orderitem.product', 'user'])
                        ->latest()
                        ->take(10)
                        ->get();

            $pdf = Pdf::loadView('pdf.venda', compact('orders'));
            
            $fileName = 'venda.pdf';
            $pdf->save(storage_path("app/public/{$fileName}"));

            // Retorna o download do arquivo
            return response()->download(storage_path("app/public/{$fileName}"));

        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao gerar o PDF: ' . $e->getMessage());
        }
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
         if (!empty($this->query)) {
            $pedidos->where(function ($query) {
            $query->whereHas('client', function ($q) {
                $q->where('name', 'like', '%' . $this->query . '%');
            })
            ->orWhereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->query . '%');
            });
        });
    }
       
        return view('livewire.vendas.vendas', [
            'pedidos' => $pedidos->paginate($this->perPage)
        ]);
    }
}
