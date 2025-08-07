<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Nova Categoria</h2>
    </x-slot>

    <div class="py-4 max-w-xl mx-auto">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4 ">
            @csrf

            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nome da Categoria</label>
                <input type="text" name="name" id="name"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('categories.index') }}" class="mr-4 text-gray-600 hover:underline">Cancelar</a>
                <button type="submit"
                    class="bg-blue-600 text-red-800 px-4 py-2 rounded hover:bg-blue-700 transition">Salvar</button>
            </div>
        </form>
    </div>
</x-app-layout>
