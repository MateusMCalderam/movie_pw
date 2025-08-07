<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar categorias
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Formulário de criação
    public function create()
    {
        return view('categories.create');
    }

    // Inserir no banco
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    // Formulário de edição
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Atualizar categoria
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $category->update([
            'nome' => $request->nome
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Excluir categoria
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
