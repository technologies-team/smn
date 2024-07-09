<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    public $timestamps=false;
    public const TYPE = ['variants', 'single', 'multi', 'additional','ingredient'];

    use HasFactory;
    protected $fillable=['name','price','type','parent_id','food_id'];
    protected $with=['choice'];

    public function choice(): HasMany
    {
        return $this->hasMany(Option::class,'parent_id');
    }
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
