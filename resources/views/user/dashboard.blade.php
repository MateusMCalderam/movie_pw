<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            Bem-vindo, {{ $user->name }}! 🎬
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="admin-card rounded-xl p-8 mb-8 text-center relative overflow-hidden">
                <div class="spotlight top-1/4 left-1/4"></div>
                <div class="spotlight top-3/4 right-1/4" style="animation-delay: -4s;"></div>
                
                <div class="relative z-10">
                    <h1 class="text-5xl font-bold mb-4 glow-text text-white">
                        Sua Biblioteca Pessoal 🎭
                    </h1>
                    <p class="text-xl text-gray-400 mb-6 max-w-2xl mx-auto">
                        Explore milhares de filmes, organize por gênero e ano, e descubra novos favoritos.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('user.movies') }}" class="admin-button px-8 py-3 rounded-full font-semibold text-white hover:scale-105 transform transition-all duration-300 shadow-lg">
                            🎬 Explorar Filmes
                        </a>
                        <a href="{{ route('profile.edit') }}" class="border-2 border-red-500/50 px-8 py-3 rounded-full font-semibold text-red-400 hover:bg-red-500/10 transition-all duration-300">
                            ⚙️ Configurações
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Movies -->
            @if($recentMovies->count() > 0)
                <div class="admin-card rounded-xl p-6 mb-8">
                    <h3 class="text-2xl font-semibold text-white mb-6">Filmes Recentes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($recentMovies as $movie)
                            <div class="movie-card rounded-lg overflow-hidden border border-gray-700 hover:border-red-500/50 transition-all duration-300">
                                @if($movie->cover_image)
                                    <img src="{{ getCoverUrl($movie->cover_image) }}" alt="{{ $movie->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                        <span class="text-4xl">🎬</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-white mb-2">{{ $movie->name }}</h4>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-red-400">{{ $movie->year }}</span>
                                        @if($movie->categories->count() > 0)
                                            <span class="text-xs text-gray-400">{{ $movie->categories->first()->name }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('user.movies.show', $movie) }}" class="inline-flex items-center px-3 py-2 bg-red-600/20 text-red-400 text-sm font-medium rounded-lg border border-red-500/30 hover:bg-red-600/30 hover:border-red-500/50 transition-all duration-200">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Categories Overview -->
            @if($categories->count() > 0)
                <div class="admin-card rounded-xl p-6">
                    <h3 class="text-2xl font-semibold text-white mb-6">Gêneros Disponíveis</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($categories->take(12) as $category)
                            <a href="{{ route('user.movies', ['category' => $category->id]) }}" 
                               class="movie-card rounded-lg p-4 text-center hover:border-red-500/50 transition-all duration-300">
                                <div class="text-3xl mb-2">🎭</div>
                                <h4 class="text-sm font-medium text-white mb-1">{{ $category->name }}</h4>
                                <p class="text-xs text-gray-400">{{ $category->movies_count }} filmes</p>
                            </a>
                        @endforeach
                    </div>
                    @if($categories->count() > 12)
                        <div class="text-center mt-6">
                            <a href="{{ route('user.movies') }}" class="inline-flex items-center px-6 py-3 bg-red-600/20 text-red-400 text-sm font-medium rounded-lg border border-red-500/30 hover:bg-red-600/30 hover:border-red-500/50 transition-all duration-200">
                                Ver Todos os Gêneros
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
