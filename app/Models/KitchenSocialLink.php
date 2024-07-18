<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KitchenSocialLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'facebook',
        'instagram',
        'phone',
        'snap',
        'x',
        'website',
        'tiktok',
        'kitchen_id'
    ];
    public function kitchen(): BelongsTo
    {
        return$this->belongsTo(Kitchen::class);
    }
}
