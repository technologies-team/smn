<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['location', 'items', 'coupon', 'offer'];
    public function getItemsAttribute($value)
    {
        $decodedValue = json_decode($value, true);

        return $decodedValue ?? $value;
    }
}
