<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'synopsis',
        'year',
        'cover_image',
        'trailer_link',
    ];

    protected $casts = [
        'year' => 'integer',
        'uuid' => 'string',
    ];

    protected $hidden = [
        'id',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'movie_categories')
                    ->withTimestamps()
                    ->withPivot('id');
    }
}
