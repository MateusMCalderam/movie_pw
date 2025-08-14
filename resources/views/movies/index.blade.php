<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            Lista de Filmes 🎬
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Actions -->
            <div class="admin-card rounded-xl p-6 mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h1 class="text-3xl font-bold text-white">Gerenciar Filmes</h1>
                    <a href="{{ route('admin.movies.create') }}" class="icon-button admin-button px-6 py-3 rounded-full font-semibold text-white hover:scale-105 transform transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Adicionar Filme
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

            <!-- Movies Table -->
            <div class="admin-card rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="admin-table w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    Nome
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    Ano
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($movies as $movie)
                                <tr class="hover:bg-gray-800/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-white font-medium">{{ $movie->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30">
                                            {{ $movie->year }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('admin.movies.edit', $movie) }}" 
                                               class="icon-button inline-flex items-center px-3 py-2 border border-yellow-500/30 text-yellow-400 bg-yellow-500/10 rounded-md text-sm font-medium hover:bg-yellow-500/20 hover:border-yellow-500/50 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Editar
                                            </a>
                                            <form id="deleteForm" method="POST" action="{{ route('admin.movies.destroy', $movie) }}"">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    class="icon-button inline-flex items-center px-3 py-2 border border-red-500/30 text-red-400 bg-red-500/10 rounded-md text-sm font-medium hover:bg-red-500/20 hover:border-red-500/50 transition-all duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($movies->hasPages())
                    <div class="px-6 py-4 border-t border-gray-700">
                        <div class="flex justify-center">
                            {{ $movies->links() }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Empty State -->
            @if($movies->isEmpty())
                <div class="admin-card rounded-xl p-12 text-center">
                    <div class="emoji-icon">🎬</div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Nenhum filme encontrado</h3>
                    <p class="text-gray-400 mb-6">Comece adicionando seu primeiro filme à plataforma.</p>
                    <a href="{{ route('admin.movies.create') }}" class="icon-button admin-button px-8 py-3 rounded-full font-semibold text-white hover:scale-105 transform transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Adicionar Primeiro Filme
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
