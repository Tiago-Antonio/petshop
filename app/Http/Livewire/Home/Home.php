<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

use App\Models\User;
use App\Models\Client;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $usuarios_count;
    public $produtos_count;
    public $clientes_count;
    public $suppliers_count;
    public $usuario_name;
    public $clientes_adicionados_hoje;
    public $ultimos_clientes;
    public $query_produtos;
    public $min_produtos;
    public $funcionarios_pedidos;

    public function render()
    {

        $user_id = Auth::user()->id;

        $this->funcionarios_pedidos = Order::where('user_id', $user_id)->count();   

        
        $this->clientes_adicionados_hoje = Client::whereDate('created_at', Carbon::today())->count(); 
        $this->usuario_name = Auth::user()->name;

        $this->ultimos_clientes = Client::latest()->take(3)->get();

        $this->usuarios_count = User::count();
        $this->produtos_count = Product::count();
        $this->clientes_count = Client::count();
        $this->suppliers_count = Supplier::count();


        $this->query_produtos = Product::selectRaw('LEFT(name, 8) as name, current_stock')
            ->whereNotNull('current_stock')
            ->orderBy('current_stock', 'asc')
            ->take(15)
            ->get();
        
        $this->min_produtos = Product::whereColumn('current_stock', '<=', 'min_stock')->get();
        
        return view('livewire.home.home');
    }
}
