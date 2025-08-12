<x-app-layout>
    <x-slot name="header"><h2>Categorias</h2></x-slot>

    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">Nova Categoria</a>

    @if(session('success'))
        <div class="mt-2 text-green-600">{{ session('success') }}</div>
    @endif

    <ul class="mt-4 space-y-2">
        @foreach($categories as $category)
            <li class="flex items-center justify-between border-b pb-2">
                <span>{{ $category->name }}</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline">Editar</a>

                    <!-- Botão para abrir modal -->
                    <button 
                        class="text-red-600 hover:underline"
                        onclick="openDeleteModal({{ $category->id }}, '{{ $category->name }}')">
                        Excluir
                    </button>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold mb-4">Confirmar Exclusão</h2>
            <p class="mb-4 text-gray-700">Tem certeza que deseja excluir a categoria <strong id="modalCategoryName"></strong>?</p>

            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Excluir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('modalCategoryName').textContent = name;
            document.getElementById('deleteForm').action = `/categories/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
