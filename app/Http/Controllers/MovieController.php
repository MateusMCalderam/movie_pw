<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
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
        $categories = Category::all();
        return view('movies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'year' => 'required|digits:4|integer|min:1900',
            'cover_image' => 'nullable|string',
            'trailer_link' => 'nullable|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('covers', 'public');
            $movie->cover_image = asset('storage/' . $path);
        } else {
            $movie->cover_image = $request->input('cover_image');
        }


        $validated['uuid'] = Str::uuid();

        $movie = Movie::create($validated);

        if (!empty($validated['categories'])) {
            $movie->categories()->sync($validated['categories']);
        }

        return redirect()->route('admin.movies.index')
            ->with('success', 'Filme criado com sucesso!');
    }


    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        $selectedCategories = $movie->categories->pluck('id')->toArray();

        return view('movies.edit', compact('movie', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'year' => 'required|digits:4|integer|min:1900',
            'cover_image' => 'nullable|string',
            'trailer_link' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('covers', 'public');
            $movie->cover_image = asset('storage/' . $path);
        } else {
            $movie->cover_image = $request->input('cover_image');
        }

        $movie->update($validated);

        $movie->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Filme atualizado com sucesso!');
    }


    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()
            ->route('admin.movies.index')
            ->with('success', "O filme '{$movie->name}' foi excluído com sucesso!");
    }
}
