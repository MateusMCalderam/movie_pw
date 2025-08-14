<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            Editar Categoria 🏷️
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="admin-card rounded-xl p-6 mb-8">
                <h1 class="text-3xl font-bold text-white">Editar Categoria</h1>
                <p class="text-gray-400 mt-2">Atualize as informações da categoria "{{ $category->name }}"</p>
            </div>

            <!-- Form -->
            <div class="admin-card rounded-xl p-8">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-white mb-2">
                            Nome da Categoria *
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                               value="{{ old('name', $category->name) }}" 
                               required
                               placeholder="Ex: Ação, Drama, Comédia...">
                        @error('name')
                            <div class="text-red-400 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-700">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="icon-button px-6 py-3 border-2 border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700/50 transition-all duration-200 text-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="icon-button admin-button px-8 py-3 rounded-lg text-white hover:scale-105 transform transition-all duration-200 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Atualizar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
