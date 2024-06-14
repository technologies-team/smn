<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class StripePayment extends Model
{

    use HasFactory;
    protected $fillable = [
        'id',
        'payment_id',
        'user_id',
        'amount',
        'currency',
        'status',
        'description',
        'receipt_url',
        'payment_date',
    ];
}
