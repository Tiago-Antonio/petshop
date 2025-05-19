<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


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



    public function stockentries(): HasMany
    {
        return $this->hasMany(StockEntry::class);
    }

}
