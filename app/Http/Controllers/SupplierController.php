<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function labelDataGraphicPie()
    {
        $dados = Supplier::withCount('stockEntries')
            ->orderByDesc('stock_entries_count')
            ->limit(5)
            ->get(['id', 'name']);

        $labels = $dados->pluck('name');
        $data = $dados->pluck('stock_entries_count');

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
