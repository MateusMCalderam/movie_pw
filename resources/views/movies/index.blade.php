<x-app-layout>
<div class="container">
    <h1>Lista de Filmes</h1>
    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Adicionar Filme</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie->name }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>
                        <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $movies->links() }}
</div>
</x-app-layout>
