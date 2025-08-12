<x-app-layout>
<div class="container">
    <h1>Editar Filme</h1>

    {{-- Mensagens de erro --}}
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

    {{-- Formulário de edição --}}
    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome do Filme</label>
            <input type="text" name="name" id="name"
                class="form-control" value="{{ old('name', $movie->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopse</label>
            <textarea name="synopsis" id="synopsis" class="form-control" rows="4">{{ old('synopsis', $movie->synopsis) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Ano de Lançamento</label>
            <input type="number" name="year" id="year"
                class="form-control" value="{{ old('year', $movie->year) }}"
                min="1900" max="{{ date('Y') }}" required>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">URL da Imagem de Capa</label>
            <input type="text" name="cover_image" id="cover_image"
                class="form-control" value="{{ old('cover_image', $movie->cover_image) }}">
        </div>

        <div class="mb-3">
            <label for="trailer_link" class="form-label">Link do Trailer</label>
            <input type="text" name="trailer_link" id="trailer_link"
                class="form-control" value="{{ old('trailer_link', $movie->trailer_link) }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</x-app-layout>