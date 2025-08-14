<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            Categorias 🏷️
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Actions -->
            <div class="admin-card rounded-xl p-6 mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h1 class="text-3xl font-bold text-white">Gerenciar Categorias</h1>
                    <a href="{{ route('admin.categories.create') }}" class="icon-button admin-button px-6 py-3 rounded-full font-semibold text-white hover:scale-105 transform transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nova Categoria
                    </a>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="admin-card rounded-xl p-4 mb-6 border-l-4 border-green-500 bg-green-500/10">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-green-400 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Categories List -->
            <div class="admin-card rounded-xl p-6">
                @if($categories->isEmpty())
                    <div class="text-center py-12">
                        <div class="emoji-icon">🏷️</div>
                        <h3 class="text-2xl font-semibold text-white mb-2">Nenhuma categoria encontrada</h3>
                        <p class="text-gray-400 mb-6">Comece criando sua primeira categoria para organizar os filmes.</p>
                        <a href="{{ route('admin.categories.create') }}" class="icon-button admin-button px-8 py-3 rounded-full font-semibold text-white hover:scale-105 transform transition-all duration-300 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Criar Primeira Categoria
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($categories as $category)
                            <div class="admin-card rounded-lg p-6 hover:border-red-500/50 transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-white mb-2">{{ $category->name }}</h3>
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                                {{ $category->movies_count ?? 0 }} filmes
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 ml-4">
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="icon-button inline-flex items-center px-3 py-2 border border-yellow-500/30 text-yellow-400 bg-yellow-500/10 rounded-md text-sm font-medium hover:bg-yellow-500/20 hover:border-yellow-500/50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form id="deleteForm" method="POST" action="{{ route('admin.categories.destroy', $category) }}"">
                                                @csrf
                                                @method('DELETE')
                                        <button 
                                            class="icon-button inline-flex items-center px-3 py-2 border border-red-500/30 text-red-400 bg-red-500/10 rounded-md text-sm font-medium hover:bg-red-500/20 hover:border-red-500/50 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
