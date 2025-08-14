<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMovies = Movie::with('categories')->take(6)->get();
        $categories = Category::withCount('movies')->take(8)->get();
        
        return view('welcome', compact('featuredMovies', 'categories'));
    }

    public function userDashboard()
    {
        $user = auth()->user();
        $recentMovies = Movie::with('categories')->latest()->take(8)->get();
        $categories = Category::withCount('movies')->get();
        
        return view('user.dashboard', compact('user', 'recentMovies', 'categories'));
    }

    public function movies(Request $request)
    {
        $query = Movie::with('categories');

        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $movies = $query->paginate(20);
        $categories = Category::all();
        $years = Movie::distinct()->pluck('year')->sort()->reverse();
        
        return view('user.movies', compact('movies', 'categories', 'years'));
    }

    public function showMovie(Movie $movie)
    {
        $movie->load('categories');
        $relatedMovies = Movie::whereHas('categories', function($query) use ($movie) {
            $query->whereIn('categories.id', $movie->categories->pluck('id'));
        })->where('id', '!=', $movie->id)->take(6)->get();
        
        return view('user.movie-show', compact('movie', 'relatedMovies'));
    }
}
