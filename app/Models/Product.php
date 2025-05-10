<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'sale_price',
        'current_stock', 
        'min_stock',  
        'photo_path',           
    ];


    public function entradas()
    {
        return $this->hasMany(StockEntry::class);
    }

    public function fornecedores()
    {
        return $this->belongsToMany(Supplier::class, 'stock_entries')
                    ->withPivot(['quantity', 'unit_price', 'entry_date'])
                    ->withTimestamps();
    }

}
