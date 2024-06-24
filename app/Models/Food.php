<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table="foods";
    use HasFactory;
    protected $fillable=[
        'title', 'title_ar', 'description_ar', 'weight', 'deliverable', 'unit', 'preparation_time',
        'ingredients', 'price', 'kitchen_id', 'category_id', 'rewards',
        'photo_id', 'description'
    ];
}
