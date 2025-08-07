<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(10);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'year' => 'required|digits:4|integer|min:1900',
            'cover_image' => 'nullable|string',
            'trailer_link' => 'nullable|string',
        ]);

        $validated['uuid'] = Str::uuid();
        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Filme criado com sucesso!');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'year' => 'required|digits:4|integer|min:1900',
            'cover_image' => 'nullable|string',
            'trailer_link' => 'nullable|string',
        ]);

        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Filme excluído com sucesso!');
    }
}
