@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Filme</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros abaixo:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.movies.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-white mb-2">
                    Nome do Filme *
                </label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                       value="{{ old('name', $movie->name ?? '') }}" 
                       required
                       placeholder="Digite o nome do filme">
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-white mb-2">
                    Ano de Lançamento *
                </label>
                <input type="number" 
                       name="year" 
                       id="year"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                       value="{{ old('year', $movie->year ?? '') }}"
                       min="1900" 
                       max="{{ date('Y') }}" 
                       required
                       placeholder="Ex: 2024">
            </div>
        </div>

        <div>
            <label for="synopsis" class="block text-sm font-medium text-white mb-2">
                Sinopse
            </label>
            <textarea name="synopsis" 
                      id="synopsis" 
                      rows="4"
                      class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                      placeholder="Descreva a sinopse do filme">{{ old('synopsis', $movie->synopsis ?? '') }}</textarea>
        </div>

        <div>
            <label for="cover_image" class="block text-sm font-medium text-white mb-2">
                URL da Imagem de Capa
            </label>
            <input type="text" 
                   name="cover_image" 
                   id="cover_image"
                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                   value="{{ old('cover_image', $movie->cover_image ?? '') }}"
                   placeholder="https://exemplo.com/imagem.jpg">
        </div>

        <div>
            <label for="trailer_link" class="block text-sm font-medium text-white mb-2">
                Link do Trailer
            </label>
            <input type="text" 
                   name="trailer_link" 
                   id="trailer_link"
                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                   value="{{ old('trailer_link', $movie->trailer_link ?? '') }}"
                   placeholder="https://youtube.com/watch?v=...">
        </div>
    </form>
</div>
@endsection
