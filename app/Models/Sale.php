<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'sale_date',
        'total_amount',
    ];
}
