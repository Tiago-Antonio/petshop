<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

use App\Models\User;
use App\Models\Client;
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

    public function render()
    {
        $this->clientes_adicionados_hoje = Client::whereDate('created_at', Carbon::today())->count(); 
        $this->usuario_name = Auth::user()->name;

        $this->ultimos_clientes = Client::latest()->take(3)->get();

        $this->usuarios_count = User::count();
        $this->produtos_count = Product::count();
        $this->clientes_count = Client::count();
        $this->suppliers_count = Supplier::count();


        $this->query_produtos = Product::selectRaw('LEFT(name, 8) as name, current_stock')
            ->orderBy('id', 'asc')
            ->get();

        
        return view('livewire.home.home');
    }
}
