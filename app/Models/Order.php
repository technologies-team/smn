<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;

/**
 * @method static whereDate(string $string, \Carbon\Carbon $currentDate)
 */
class Order extends Model
{
    use HasFactory;

    protected $with = ['user', 'orderDetail'];
    protected $fillable = ['kitchen_id','user_id', 'status', 'payment_method','order_time'];
    const STATUS = ['waiting', 'cooking', 'ready_to_delivery', 'cancel', 'reject', 'complete'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail(): HasOne
    {
        return $this->hasOne(OrderDetail::class);

    }

    public function orderLog(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
