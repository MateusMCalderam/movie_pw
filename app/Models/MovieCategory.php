<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieCategory extends Model
{
    use HasFactory;

    protected $table = 'movie_categories';

    public $timestamps = true;

    protected $fillable = [
        'movie_id',
        'category_id',
    ];

    protected $casts = [
        'movie_id' => 'integer',
        'category_id' => 'integer',
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByMovie($query, $movieId)
    {
        return $query->where('movie_id', $movieId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public static function exists($movieId, $categoryId): bool
    {
        return static::where('movie_id', $movieId)
                    ->where('category_id', $categoryId)
                    ->exists();
    }

    public static function createIfNotExists($movieId, $categoryId): self
    {
        return static::firstOrCreate([
            'movie_id' => $movieId,
            'category_id' => $categoryId,
        ]);
    }
}
