<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Supplier;

class StockEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'unit_price',
        'entry_date',
    ];

    public function produto()
    {
        return $this->belongsTo(Product::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Supplier::class);
    }
}
