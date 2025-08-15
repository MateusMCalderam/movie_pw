<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\CategoriesSeederFromAPI;
use Database\Seeders\TrendingMoviesSeederFromAPI;

class SeedMoviesAndCategories extends Command
{
    protected $signature = 'seed:movies-categories 
                            {--categories-only : Executar apenas o seeder de categorias}
                            {--movies-only : Executar apenas o seeder de filmes}
                            {--force : Forçar execução sem confirmação}';

    protected $description = 'Executa os seeders de categorias e filmes da API do TMDB';

    public function handle()
    {
        $this->info('Iniciando seeders de filmes e categorias...');
        
        $apiKey = config('services.tmdb.api_key');
        if (empty($apiKey)) {
            $this->error('Chave da API do TMDB não configurada!');
            $this->error('Configure a variável TMDB_API_KEY no arquivo .env');
            return 1;
        }

        $this->info('Chave da API configurada: ' . substr($apiKey, 0, 8) . '...');

        if ($this->option('categories-only')) {
            $this->seedCategories();
        } elseif ($this->option('movies-only')) {
            $this->seedMovies();
        } else {
            if (!$this->option('force') && !$this->confirm('Deseja executar ambos os seeders?')) {
                $this->info('Operação cancelada.');
                return 0;
            }
            
            $this->seedCategories();
            $this->seedMovies();
        }

        $this->info('Seeders executados com sucesso!');
        return 0;
    }

    protected function seedCategories(): void
    {
        $this->info('Executando seeder de categorias...');
        
        try {
            $seeder = new CategoriesSeederFromAPI();
            $seeder->setCommand($this);
            $seeder->run();
            
            $this->info('Categorias importadas com sucesso!');
        } catch (\Exception $e) {
            $this->error('Erro ao importar categorias: ' . $e->getMessage());
        }
    }

    protected function seedMovies(): void
    {
        $this->info('Executando seeder de filmes...');
        
        try {
            $seeder = new TrendingMoviesSeederFromAPI();
            $seeder->setCommand($this);
            $seeder->run();
            
            $this->info('Filmes importados com sucesso!');
        } catch (\Exception $e) {
            $this->error('Erro ao importar filmes: ' . $e->getMessage());
        }
    }
}
