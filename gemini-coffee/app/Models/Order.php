<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email',
        'address_line', 'city', 'state', 'postal_code',
        'shipping_method', 'shipping_price',
        'subtotal', 'tax', 'total', 'status',
    ];

    protected function casts(): array
    {
        return [
            'shipping_price' => 'decimal:2',
            'subtotal'       => 'decimal:2',
            'tax'            => 'decimal:2',
            'total'          => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
