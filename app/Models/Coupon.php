<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method where(string $string, string $string1, \Illuminate\Support\Carbon $now)
 */
class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['count'];
    const TYPE = ['fixed', 'percent_limited', 'percent', ''];
}
