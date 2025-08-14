<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            {{ $movie->name }} 🎬
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('user.dashboard') }}" class="text-gray-400 hover:text-red-500 transition-colors">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-600 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('user.movies') }}" class="text-gray-400 hover:text-red-500 transition-colors">
                                    Filmes
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-600 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-red-400">{{ $movie->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Movie Details -->
            <div class="admin-card rounded-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                    <!-- Cover Image -->
                    <div class="lg:col-span-1">
                        @if($movie->cover_image)
                            <img src="{{ $movie->cover_image }}" 
                                 alt="{{ $movie->name }}" 
                                 class="w-full h-96 lg:h-full object-cover">
                        @else
                            <div class="w-full h-96 lg:h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                <span class="text-8xl">🎬</span>
                            </div>
                        @endif
                    </div>

                    <!-- Movie Info -->
                    <div class="lg:col-span-2 p-8">
                        <div class="mb-6">
                            <h1 class="text-4xl font-bold text-white mb-4">{{ $movie->name }}</h1>
                            
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                    {{ $movie->year }}
                                </span>
                                
                                @foreach($movie->categories as $category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-600/20 text-gray-300 border border-gray-600/30">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>

                            @if($movie->synopsis)
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-white mb-2">Sinopse</h3>
                                    <p class="text-gray-400 leading-relaxed">{{ $movie->synopsis }}</p>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-4">
                                @if($movie->trailer_link)
                                    <a href="{{ $movie->trailer_link }}" 
                                       target="_blank"
                                       class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors shadow-lg">
                                        🎥 Assistir Trailer
                                    </a>
                                @endif
                                
                                <a href="{{ route('user.movies') }}" 
                                   class="inline-flex items-center px-6 py-3 border-2 border-gray-600 text-gray-300 font-medium rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                                    ← Voltar aos Filmes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Movies -->
            @if($relatedMovies->count() > 0)
                <div class="mt-12">
                    <h3 class="text-2xl font-semibold text-white mb-6">Filmes Relacionados</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($relatedMovies as $relatedMovie)
                            <div class="movie-card rounded-xl overflow-hidden border border-gray-700 hover:border-red-500/50 transition-all duration-300 group">
                                @if($relatedMovie->cover_image)
                                    <div class="relative overflow-hidden">
                                        <img src="{{ $relatedMovie->cover_image }}" 
                                             alt="{{ $relatedMovie->name }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300"></div>
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                        <span class="text-4xl">🎬</span>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-white mb-2 group-hover:text-red-400 transition-colors duration-200">
                                        {{ $relatedMovie->name }}
                                    </h4>
                                    
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-sm text-red-400">{{ $relatedMovie->year }}</span>
                                        @if($relatedMovie->categories->count() > 0)
                                            <span class="text-xs text-gray-400">{{ $relatedMovie->categories->first()->name }}</span>
                                        @endif
                                    </div>
                                    
                                    <a href="{{ route('user.movies.show', $relatedMovie) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-red-600/20 text-red-400 text-sm font-medium rounded-lg border border-red-500/30 hover:bg-red-600/30 hover:border-red-500/50 transition-all duration-200">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Back to Movies -->
            <div class="mt-12 text-center">
                <a href="{{ route('user.movies') }}" 
                   class="inline-flex items-center px-8 py-4 border-2 border-gray-600 text-gray-300 font-medium rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                    ← Voltar ao Catálogo Completo
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
