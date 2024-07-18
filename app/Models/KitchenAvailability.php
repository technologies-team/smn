<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenAvailability extends Model
{
    use HasFactory;
    protected $fillable = ['setting_id', 'day', 'is_available','start_time', 'end_time'];
    const DAYS=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    protected $casts = [
        'is_available' => 'boolean',
    ];
}
