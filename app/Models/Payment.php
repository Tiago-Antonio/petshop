<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    protected $fillable = [
        'payment_method',        
    ];


    public function order(): HasMany{
        return $this->hasMany(Order::class);
    }
}
