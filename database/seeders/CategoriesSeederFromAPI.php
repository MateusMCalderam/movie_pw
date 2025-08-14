<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Category;

class CategoriesSeederFromAPI extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKey = config('services.tmdb.api_key');

        $this->command->info('Buscando gêneros de filmes da API do TMDB...');

        $response = Http::withToken($apiKey)
            ->get("https://api.themoviedb.org/3/genre/movie/list?language=pt-BR");

        if ($response->successful()) {
            $genres = $response->json('genres');

            $this->command->info("Encontrados " . count($genres) . " gêneros.");

            foreach ($genres as $genre) {
                Category::updateOrCreate(
                    ['name' => $genre['name']],
                    [
                        'name' => $genre['name'],
                        'uuid' => \Illuminate\Support\Str::uuid(),
                    ]
                );

                $this->command->info("Gênero criado/atualizado: {$genre['name']}");
            }

            $this->command->info('Gêneros importados com sucesso!');
        } else {
            $this->command->error('Erro ao buscar gêneros do TMDB: ' . $response->status());
            $this->command->error($response->body());
        }
    }
}
