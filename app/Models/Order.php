<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'payment_id',
        'total_amount',
        'status',
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

    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class, 'order_id');
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
