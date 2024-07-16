<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenSetting extends Model
{
    use HasFactory;

    const DELIVERY_TYPE = ['smn','pickup','kitchen'];
    protected $fillable=['delivery_type','kitchen_id'];


}
