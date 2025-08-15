<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            Catálogo de Filmes 🎬
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtros -->
            <div class="admin-card rounded-xl p-6 mb-8">
                <h3 class="text-2xl font-semibold text-white mb-6">Filtros e Busca</h3>
                
                <form method="GET" action="{{ route('user.movies') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Busca -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Buscar Filme</label>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Nome do filme..."
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Gênero</label>
                            <select name="category" 
                                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                                <option value="">Todos os gêneros</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ano -->
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Ano</label>
                            <select name="year" 
                                    class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                                <option value="">Todos os anos</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botões -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" 
                                    class="admin-button px-6 py-3 rounded-lg text-white hover:scale-105 transform transition-all duration-200 shadow-lg">
                                🔍 Filtrar
                            </button>
                            <a href="{{ route('user.movies') }}" 
                               class="px-6 py-3 border-2 border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                                Limpar
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Resultados da busca -->
                @if(request('search') || request('category') || request('year'))
                    <div class="mt-4 p-4 bg-gray-800/30 rounded-lg border border-gray-700">
                        <p class="text-gray-300">
                            <span class="font-medium">Filtros ativos:</span>
                            @if(request('search')) Busca: "{{ request('search') }}" @endif
                            @if(request('category')) 
                                @if(request('search')) | @endif
                                Gênero: {{ $categories->find(request('category'))->name ?? 'N/A' }}
                            @endif
                            @if(request('year'))
                                @if(request('search') || request('category')) | @endif
                                Ano: {{ request('year') }}
                            @endif
                        </p>
                    </div>
                @endif
            </div>

            <!-- Resultados -->
            <div class="admin-card rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-white">
                        Filmes Encontrados 
                        @if($movies->total() > 0)
                            <span class="text-red-400">({{ $movies->total() }})</span>
                        @endif
                    </h3>
                    
                    @if($movies->total() > 0)
                        <div class="text-gray-400">
                            Mostrando {{ $movies->firstItem() }}-{{ $movies->lastItem() }} de {{ $movies->total() }}
                        </div>
                    @endif
                </div>

                @if($movies->count() > 0)
                    <!-- Grid de Filmes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($movies as $movie)
                            <div class="movie-card rounded-xl overflow-hidden border border-gray-700 hover:border-red-500/50 transition-all duration-300 group">
                                @if($movie->cover_image)
                                    <div class="relative overflow-hidden">
                                        <img src="{{ getCoverUrl($movie->cover_image) }}" 
                                             alt="{{ $movie->name }}" 
                                             class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300"></div>
                                    </div>
                                @else
                                    <div class="w-full h-80 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                        <span class="text-6xl">🎬</span>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <h4 class="text-xl font-bold text-white mb-3 group-hover:text-red-400 transition-colors duration-200">
                                        {{ $movie->name }}
                                    </h4>
                                    
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                            {{ $movie->year }}
                                        </span>
                                        @if($movie->categories->count() > 0)
                                            <span class="text-sm text-gray-400">{{ $movie->categories->first()->name }}</span>
                                        @endif
                                    </div>
                                    
                                    @if($movie->synopsis)
                                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                                            {{ Str::limit($movie->synopsis, 120) }}
                                        </p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('user.movies.show', $movie) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                            Ver Detalhes
                                        </a>
                                        
                                        @if($movie->trailer_link)
                                            <a href="{{ $movie->trailer_link }}" 
                                               target="_blank"
                                               class="inline-flex items-center px-3 py-2 border border-gray-600 text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                                                🎥 Trailer
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginação -->
                    @if($movies->hasPages())
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            <div class="flex justify-center">
                                {{ $movies->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @endif

                @else
                    <!-- Estado vazio -->
                    <div class="text-center py-16">
                        <div class="text-8xl mb-6">🎬</div>
                        <h3 class="text-2xl font-semibold text-white mb-4">Nenhum filme encontrado</h3>
                        <p class="text-gray-400 mb-8 max-w-md mx-auto">
                            @if(request('search') || request('category') || request('year'))
                                Tente ajustar os filtros ou fazer uma nova busca.
                            @else
                                Parece que ainda não há filmes disponíveis no momento.
                            @endif
                        </p>
                        <div class="flex flex-wrap justify-center gap-4">
                            @if(request('search') || request('category') || request('year'))
                                <a href="{{ route('user.movies') }}" 
                                   class="admin-button px-6 py-3 rounded-lg text-white hover:scale-105 transform transition-all duration-200 shadow-lg">
                                    Limpar Filtros
                                </a>
                            @endif
                            <a href="{{ route('user.dashboard') }}" 
                               class="border-2 border-gray-600 text-gray-300 px-6 py-3 rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                                Voltar ao Dashboard
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
