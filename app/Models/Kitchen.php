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
protected $table="kitchens";
    protected $fillable = [
        'user_id',
        'title',
        'title_ar',
        'description',
        'description_ar',
        'phone',
        'mobile',
        'verified',
        'ready_to_delivery',
        'delivery_fee',
        'status',
        'active',
        'photo_id',
        'front_id',
        'back_id',
        'cover_id'
    ];
protected $with=['tags','user','photo','cover'];

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
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Attachment::class,'photo_id');
    }
    public function cover(): BelongsTo
    {
        return $this->belongsTo(Attachment::class,'cover_id');
    }

}
