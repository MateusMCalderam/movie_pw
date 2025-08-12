<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'synopsis',
        'year',
        'cover_image',
        'trailer_link',
    ];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
