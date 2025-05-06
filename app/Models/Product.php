<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'description',
        'purchase_price',
        'sale_price',
        'current_stock', 
        'min_stock',            
    ];

}
