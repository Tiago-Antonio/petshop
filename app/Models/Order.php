<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'user_id',
        'total_amount',
        'status',
        'order_date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function orderitem(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
