<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'sale_date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}
