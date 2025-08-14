<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';

    protected $fillable = [
        'uuid',
        'name',
    ];

    protected $casts = [
        'name' => 'string',
        'uuid' => 'string',
    ];

    protected $hidden = [
        'id',
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_categories')
                    ->withTimestamps()
                    ->withPivot('id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    public function getDisplayNameAttribute(): string
    {
        return ucfirst(strtolower($this->name));
    }

    public function hasMovies(): bool
    {
        return $this->movies()->exists();
    }

    public function getMoviesCountAttribute(): int
    {
        return $this->movies()->count();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
