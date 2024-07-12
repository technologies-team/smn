<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
