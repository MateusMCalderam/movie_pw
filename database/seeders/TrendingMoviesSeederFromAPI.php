<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Movie;
use App\Models\Category;

class TrendingMoviesSeederFromAPI extends Seeder
{
    public function run(): void
    {
        $apiKey = config('services.tmdb.api_key');
        
        $response = Http::withToken($apiKey)
            ->get("https://api.themoviedb.org/3/trending/movie/week?language=pt-BR");

        if ($response->successful()) {
            $movies = $response->json('results');

            foreach ($movies as $movie) {
                $this->command->info("Processando filme: {$movie['title']}");

                $movieModel = Movie::firstOrCreate(
                    ['name' => $movie['title']],
                    [
                        'uuid' => Str::uuid(),
                        'synopsis' => $movie['overview'] ?? null,
                        'year' => isset($movie['release_date']) ? substr($movie['release_date'], 0, 4) : null,
                        'cover_image' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : null,
                        'trailer_link' => $this->getTrailerLink($movie['id'], $apiKey),
                    ]
                );

                if (empty($movieModel->uuid)) {
                    $movieModel->uuid = Str::uuid();
                    $movieModel->save();
                }

                $this->attachMovieGenres($movieModel, $movie['id'], $apiKey);
            }

            $this->command->info('Filmes importados com sucesso!');
        } else {
            $this->command->error('Erro ao buscar filmes do TMDB: ' . $response->status());
            $this->command->error($response->body());
        }
    }

    protected function getTrailerLink($movieId, $apiKey): ?string
    {
        $response = Http::withToken($apiKey)
            ->get("https://api.themoviedb.org/3/movie/{$movieId}/videos?language=pt-BR");   

        if ($response->successful()) {
            $videos = $response->json('results');

            $trailer = collect($videos)->firstWhere('type', 'Trailer');

            if ($trailer && $trailer['site'] === 'YouTube') {
                return 'https://www.youtube.com/watch?v=' . $trailer['key'];
            }
        }

        return null;
    }

    protected function attachMovieGenres($movieModel, $movieId, $apiKey): void
    {
        $response = Http::withToken($apiKey)
            ->get("https://api.themoviedb.org/3/movie/{$movieId}?language=pt-BR");

        if ($response->successful()) {
            $movieDetails = $response->json();
            $genres = $movieDetails['genres'] ?? [];

            $categoryIds = [];
            foreach ($genres as $genre) {
                $category = Category::where('name', $genre['name'])->first();
                if ($category) {
                    $categoryIds[] = $category->id;
                }
            }

            if (!empty($categoryIds)) {
                $movieModel->categories()->sync($categoryIds);
                $this->command->info("  - Gêneros associados: " . implode(', ', collect($genres)->pluck('name')->toArray()));
            }
        }
    }
}
