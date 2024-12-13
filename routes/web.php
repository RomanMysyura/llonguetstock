<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdminController;

use App\Models\Category;

Route::get('/', function () {
    $categories = Category::all();
    return Inertia::render('Welcome', [
        'categories' => $categories
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin', [AdminController::class, 'show']);

Route::get('/{id}', [CategoriaController::class, 'show']);
Route::get('/api/getallcatories', [CategoriaController::class, 'getallcatories']);
require __DIR__.'/auth.php';
