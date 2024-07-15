<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'message',
        'rate',
    ];

   const   STARS = [1, 2, 3, 4, 5];
   protected $with=['user','order'];
   const   STATUS = ["init", "post","draft","publish",'ignore'];
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }  public function order(): BelongsTo
   {
       return $this->belongsTo(Order::class);
   }
}
