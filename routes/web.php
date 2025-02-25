<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AdminMiddleware;


use App\Models\Category;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/category/{id}', [CategoriaController::class, 'show']);
    Route::post('/api/createcategory', [CategoriaController::class, 'store']);
    Route::get('/api/getallcategories', [CategoriaController::class, 'getallcategories']);
    Route::get('/api/getallmovements', [ProductController::class, 'getallmovements']);
    Route::get('/', function () {
        $categories = Category::all();
        return Inertia::render('Welcome', [
        'categories' => $categories
        ]);
    });

});
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'show']);
    Route::post('/changeproductquanity', [ProductController::class, 'changeproductquanity']);
    Route::post('/unsignproduct', [ProductController::class, 'unsignproduct']);
    Route::post('/api/createproduct', [ProductController::class, 'createproduct']);
    Route::post('/api/updateproduct', [ProductController::class, 'updateproduct']);
    Route::delete('/api/category/{id}', [CategoriaController::class, 'destroy']);

});


require __DIR__.'/auth.php';
