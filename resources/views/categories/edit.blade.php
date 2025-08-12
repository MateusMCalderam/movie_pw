<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Editar Categoria</h2>
    </x-slot>

    <div class="py-4 max-w-4xl mx-auto">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nome da Categoria</label>
                <input type="text" name="name" id="name"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('categories.index') }}" class="mr-4 text-gray-600 hover:underline">Cancelar</a>
                <button type="submit"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                    Atualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
