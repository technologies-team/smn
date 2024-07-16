<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KitchenSetting extends Model
{
    use HasFactory;

    const DELIVERY_TYPE = ['smn','pickup','kitchen'];
    protected $fillable=['delivery_type','kitchen_id'];

    public function kitchen(): BelongsTo
    {
        return$this->belongsTo(Kitchen::class);
    }
    public function availability(): HasMany
    {
        return $this->hasMany(KitchenAvailability::class);
    }

}
