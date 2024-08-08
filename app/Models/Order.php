<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;


class Order extends Model
{
    use HasFactory  ;

    protected $with = ['kitchen','orderDetail'];
    protected $fillable = [
        'user_id',
        'kitchen_id',
        'status',
        'price',
        'total_price',
        'rewards',
        'total_rewards',
        'discount',
        'total_discount',
        'total_fee',
        'shipping',
        'total_shipping',
        'notes',
        'payment_method',
        'order_time'
    ];
    const STATUS = ['waiting', 'cooking', 'ready_to_delivery', 'cancel', 'reject', 'complete'];
    protected $casts = [
        'price' => 'string',
        'total_price' => 'string',
        'rewards' => 'string',
        'total_rewards' => 'string',
        'discount' => 'string',
        'total_discount' => 'string',
        'total_fee' => 'string',
        'shipping' => 'string',
    ];


    public function orderDetail(): HasOne
    {
        return $this->hasOne(OrderDetail::class);

    }

    public function orderLog(): HasMany
    {
        return $this->hasMany(Log::class);
    }
    public function kitchen(): BelongsTo
{
    return $this->belongsTo(Kitchen::class,"kitchen_id");
}
}
