<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenSocialLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'facebook',
        'instagram',
        'phone',
        'snap',
        'x',
        'website',
        'kitchen_id'
    ];
}
