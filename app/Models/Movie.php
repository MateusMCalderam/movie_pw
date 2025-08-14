<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('synopsis', 'like', "%{$search}%");
    }

    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        
        return asset('images/default-movie-cover.jpg');
    }

    public function hasCoverImage(): bool
    {
        return !empty($this->cover_image);
    }

    public function hasTrailer(): bool
    {
        return !empty($this->trailer_link);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
