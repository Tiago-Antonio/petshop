<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'active',         
    ];

    public function stockEntries(): HasMany
    {
        return $this->hasMany(StockEntry::class, 'supplier_id');
    }
}
