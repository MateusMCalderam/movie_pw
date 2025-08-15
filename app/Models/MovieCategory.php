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
}
