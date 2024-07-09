<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Food extends Model
{
    protected $table="foods";
    use HasFactory;
    protected $fillable=[
        'title', 'title_ar', 'description_ar', 'weight', 'deliverable', 'unit', 'preparation_time',
        'ingredients', 'price', 'kitchen_id', 'category_id', 'rewards',
        'photo_id', 'description'
    ];
    protected $with=['ingredients'];
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'photo_id');
    }
    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
}
