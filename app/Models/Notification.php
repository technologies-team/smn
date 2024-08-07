<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at',
    ];
    use HasFactory;

    public function getDataAttribute($value)
    {
        $decodedValue = json_decode($value, true);

        return $decodedValue ?? $value;
    }

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}

