<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'kitchen_id',
        'tax',
        'total_tax',
        'price',
        'total_price',
        'discount',
        'total_discount',
        'rewards',
        'total_rewards',
        'coupon_id',
        'offer_id',
    ];}
