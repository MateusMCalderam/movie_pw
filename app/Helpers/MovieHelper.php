<?php

use Illuminate\Support\Str;
use App\Models\Movie;

if (!function_exists('getCoverUrl')) {
    function getCoverUrl(string $movie_cover_image)
    {
        if (!$movie_cover_image) return null;

        if (Str::startsWith($movie_cover_image, ['http://','https://'])) {
            return $movie_cover_image;
        }

        return asset('storage/' . $movie_cover_image);
    }
}
