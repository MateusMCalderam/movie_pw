<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight glow-text">
            Editar Filme 🎬
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="admin-card rounded-xl p-6 mb-8">
                <h1 class="text-3xl font-bold text-white">Editar Filme</h1>
                <p class="text-gray-400 mt-2">Atualize as informações do filme "{{ $movie->name }}"</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="admin-card rounded-xl p-4 mb-6 border-l-4 border-red-500 bg-red-500/10">
                    <div class="flex items-center mb-3">
                        <svg class="w-6 h-6 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <h3 class="text-red-400 font-semibold">Ops! Corrija os erros abaixo:</h3>
                    </div>
                    <ul class="list-disc list-inside text-red-400 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="admin-card rounded-xl p-8">
                <form action="{{ route('admin.movies.update', $movie) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-white mb-2">
                                Nome do Filme *
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                                value="{{ old('name', $movie->name) }}" required placeholder="Digite o nome do filme">
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-medium text-white mb-2">
                                Ano de Lançamento *
                            </label>
                            <input type="number" name="year" id="year"
                                class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                                value="{{ old('year', $movie->year) }}" min="1900" max="{{ date('Y') }}" required
                                placeholder="Ex: 2024">
                        </div>
                    </div>

                    <div>
                        <label for="synopsis" class="block text-sm font-medium text-white mb-2">
                            Sinopse
                        </label>
                        <textarea name="synopsis" id="synopsis" rows="4"
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                            placeholder="Descreva a sinopse do filme">{{ old('synopsis', $movie->synopsis) }}</textarea>
                    </div>

                    <div>
                        <label for="categories" class="block text-sm font-medium text-white mb-2">
                            Categorias
                        </label>
                        <select name="categories[]" id="categories" multiple placeholder="Selecione as categorias...">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $selectedCategories)) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">
                            Imagem de Capa
                        </label>

                        <!-- Alternativa: URL -->
                        <input type="text" name="cover_image" id="cover_image"
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                            value="{{ old('cover_image', $movie->cover_image) }}"
                            placeholder="https://exemplo.com/imagem.jpg" oninput="previewImageFromUrl()">

                        <p class="text-gray-400 text-sm mt-2">Ou selecione um arquivo abaixo</p>

                        <!-- Upload de Arquivo -->
                        <input type="file" name="cover_image_file" id="cover_image_file" class="mt-2 block w-full text-sm text-gray-400
               file:mr-4 file:py-2 file:px-4
               file:rounded-full file:border-0
               file:text-sm file:font-semibold
               file:bg-red-500 file:text-white
               hover:file:bg-red-600" accept="image/*" onchange="previewImageFromFile(event)">

                        <!-- Preview -->
                        <div class="mt-4">
                            <img id="coverPreview" src="{{ old('cover_image', $movie->cover_image) }}"
                                alt="Preview da Capa" class="max-h-64 rounded-lg border border-gray-700">
                        </div>
                    </div>


                    <div>
                        <label for="trailer_link" class="block text-sm font-medium text-white mb-2">
                            Link do Trailer (YouTube)
                        </label>
                        <input type="text" name="trailer_link" id="trailer_link"
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                            value="{{ old('trailer_link', $movie->trailer_link) }}"
                            placeholder="https://youtube.com/watch?v=..." onchange="updateTrailerPreview()">
                        <p class="text-sm text-gray-400 mt-1">Cole o link completo do YouTube para visualizar o preview
                        </p>
                    </div>

                    <!-- Trailer Preview -->
                    <div id="trailerPreview" class="hidden">
                        <label class="block text-sm font-medium text-white mb-2">
                            Preview do Trailer
                        </label>
                        <div class="trailer-preview">
                            <iframe id="trailerIframe" src="" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-700">
                        <a href="{{ route('admin.movies.index') }}"
                            class="icon-button px-6 py-3 border-2 border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700/50 transition-all duration-200 text-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit"
                            class="icon-button admin-button px-8 py-3 rounded-lg text-white hover:scale-105 transform transition-all duration-200 shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Atualizar Filme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        function previewImageFromUrl() {
            const url = document.getElementById('cover_image').value;
            const preview = document.getElementById('coverPreview');
            if (url) {
                preview.src = url;
            }
        }

        function previewImageFromFile(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('coverPreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function updateTrailerPreview() {
            const trailerLink = document.getElementById('trailer_link').value;
            const preview = document.getElementById('trailerPreview');
            const iframe = document.getElementById('trailerIframe');

            if (trailerLink && trailerLink.includes('youtube.com/watch?v=')) {
                const videoId = trailerLink.split('v=')[1];
                if (videoId) {
                    const embedUrl = `https://www.youtube.com/embed/${videoId}`;
                    iframe.src = embedUrl;
                    preview.classList.remove('hidden');
                }
            } else {
                preview.classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateTrailerPreview();
        });

        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect("#categories", {
                plugins: ['remove_button'],
                persist: false,
                create: false,
                maxItems: null,
                placeholder: "Selecione as categorias...",
                render: {
                    option: function (data, escape) {
                        return `<div class="py-2 px-3">${escape(data.text)}</div>`;
                    },
                    item: function (data, escape) {
                        return `<div class="bg-red-500 text-white rounded px-2 py-1 mr-1">${escape(data.text)}</div>`;
                    }
                }
            });
        });
    </script>
</x-app-layout>