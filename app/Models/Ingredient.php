<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
public $timestamps=false;

    use HasFactory;
    protected $fillable=['name','value','parent_id','food_id'];
}
