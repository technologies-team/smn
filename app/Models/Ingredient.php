<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
public $timestamps=false;

    use HasFactory;
    protected $fillable=['name','multi','parent_id','food_id'];
    protected $with=['choice'];

    public function choice(): HasMany
    {
        return $this->hasMany(Ingredient::class,'parent_id');
    }
}
