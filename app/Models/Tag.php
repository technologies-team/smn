<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    protected $fillable=['title','title_ar','description','kitchen_id'];
    use HasFactory;
    protected $with=['foods'];
    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}
