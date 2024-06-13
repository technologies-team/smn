<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kitchen extends Model
{
    use HasFactory;
    protected $fillable=["user_id","title","title_ar",
        "description","description_ar","active"
        ,"enabled","phone","mobile","verified","ready_to_delivery","closed","photo_id"];
public function user(): HasOne
{
    return $this->hasOne(User::class);
}
}
