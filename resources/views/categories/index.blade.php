<x-app-layout>
    <x-slot name="header"><h2>Categorias</h2></x-slot>

    <a href="{{ route('categories.create') }}">Nova Categoria</a>

    <ul>
        @foreach($categories as $category)
            <li>
                {{ $category->nome }}
                <a href="{{ route('categories.edit', $category) }}">Editar</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button>Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>
