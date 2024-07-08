<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=[
        'title','street1', 'street2' ,'longitude','phone','verified', 'latitude', 'user_id','country','city'
    ];
}
