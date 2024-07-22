<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','status'];
    const STATUS=['waiting','cooking','ready_to_delivery','cancel','reject','complete'];
    public function user(): BelongsTo
    {
      return  $this->belongsTo(User::class);
    }
}
