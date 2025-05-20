<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
