<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="admin-card rounded-xl p-8 mb-8 text-center relative overflow-hidden">
                <div class="spotlight top-1/4 left-1/4"></div>
                <div class="spotlight top-3/4 right-1/4" style="animation-delay: -4s;"></div>
                
                <div class="relative z-10">
                    <h1 class="text-5xl font-bold mb-4 glow-text text-white">
                        Bem-vindo ao Painel Admin! 🎬
                    </h1>
                    <p class="text-xl text-gray-400 mb-6 max-w-2xl mx-auto">
                        Gerencie seus filmes e categorias com estilo. Explore as funcionalidades disponíveis abaixo.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('admin.movies.index') }}" class="icon-button admin-button px-8 py-3 rounded-full font-semibold text-white hover:scale-105 transform transition-all duration-300 shadow-lg">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 18V8a1 1 0 0 1 1-1h1.5l1.707-1.707A1 1 0 0 1 8.914 5h6.172a1 1 0 0 1 .707.293L17.5 7H19a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Z"/>
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>

                            Gerenciar Filmes
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="icon-button border-2 border-red-500/50 px-8 py-3 rounded-full font-semibold text-red-400 hover:bg-red-500/10 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Gerenciar Categorias
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="emoji-card">
                    <div class="emoji-icon">🎭</div>
                    <h3 class="text-xl font-semibold text-white mb-2">Total de Filmes</h3>
                    <p class="text-3xl font-bold text-red-400">{{ \App\Models\Movie::count() }}</p>
                </div>
                
                <div class="emoji-card">
                    <div class="emoji-icon">🏷️</div>
                    <h3 class="text-xl font-semibold text-white mb-2">Total de Categorias</h3>
                    <p class="text-3xl font-bold text-red-400">{{ \App\Models\Category::count() }}</p>
                </div>
                
                <div class="emoji-card">
                    <div class="emoji-icon">👤</div>
                    <h3 class="text-xl font-semibold text-white mb-2">Usuários Ativos</h3>
                    <p class="text-3xl font-bold text-red-400">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
            
            <div class="admin-card rounded-xl p-6">
                <h3 class="text-2xl font-semibold text-white mb-6 text-center">Ações Rápidas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.movies.create') }}" class="icon-button admin-button px-6 py-4 rounded-lg font-semibold text-white text-center hover:scale-105 transform transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Adicionar Novo Filme
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="icon-button admin-button px-6 py-4 rounded-lg font-semibold text-white text-center hover:scale-105 transform transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Criar Nova Categoria
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
