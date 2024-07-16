<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenAvailability extends Model
{
    use HasFactory;
    protected $fillable = ['setting_id', 'day_of_week', 'start_time', 'end_time'];

}
