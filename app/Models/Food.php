<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PHPUnit\TestFixture\StackTest;

/**
 * @method static find($food_id)
 */
class Food extends Model
{
    protected $table="foods";
    const STATUS=['publish','hidden'];
    use HasFactory;
    protected $fillable=[
        'title', 'title_ar', 'description_ar', 'weight', 'deliverable', 'unit', 'preparation_time',
        'ingredients', 'price', 'kitchen_id', 'category_id', 'rewards',
        'photo_id', 'description','status','tag_id'
    ];
    protected $with=['option','photo','kitchen'];
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Attachment::class, 'photo_id');
    }
    public function option(): HasMany
    {
        return $this->hasMany(Option::class);
    }
    public function kitchen(): BelongsTo
    {
        return $this->belongsTo(Kitchen::class);
    }
}
