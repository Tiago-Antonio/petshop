<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CancelarPedidosAntigos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        
    }

    public function handle(): void
    {
        Log::info("Job CancelarPedidosAntigos iniciou.");
        
        // Buscar todos os pedidos com mais de 3 dias e status diferente de 'finalizado' ou 'cancelado'
        $pedidos = Order::whereNotIn('status', ['finalizado', 'cancelado'])
                        ->where('created_at', '<=', now()->subDays(3))
                        ->with('orderitem')
                        ->get();

        foreach ($pedidos as $pedido) {
            // Atualiza o status do pedido para cancelado
            $pedido->update([
                'status' => 'cancelado'
            ]);

            //devolver o estoque
            foreach ($pedido->orderitem as $item) {
                Product::where('id', $item->product_id)
                    ->increment('current_stock', $item->quantity);

                $item->update([
                    'snapshot_quantity' => $item->quantity,
                    'quantity' => 0
                ]);
            }
        }
    }
}
