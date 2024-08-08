<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'food_id',
        'cart_id',
        'coupon_id',
        'offer_id',
        'price',
        'total_price',
        'discount',
        'options',
        'total_discount',
        'quantity',
    ];
    protected $with=['food'];
    protected $casts = [
        'price' => 'string',
        'total_price' => 'string',
        'rewards' => 'string',
        'discount' => 'string',
        'total_discount' => 'string',
    ];
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
