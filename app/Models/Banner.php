<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'photo_id', 'description'
    ];
    protected
        $with = ['photo'];


    public function photo(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }}
