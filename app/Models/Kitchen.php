<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Correcting relation type for user
use Illuminate\Database\Eloquent\Relations\HasOne; // Correcting relation type for user

class Kitchen extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "title", "title_ar",
        "description", "description_ar", "active",
        "enabled", "phone", "mobile", "verified",
        "ready_to_delivery", "closed", "photo_id","delivery_fee"
    ];
protected $with=['tags'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Food
    public function food(): HasMany
    {
        return $this->hasMany(Food::class);
    }public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
