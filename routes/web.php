<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;     
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/movies', [HomeController::class, 'movies'])->name('user.movies');
        Route::get('/movies/{movie}', [HomeController::class, 'showMovie'])->name('user.movies.show');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::resource('movies', MovieController::class);
        Route::resource('categories', CategoryController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
