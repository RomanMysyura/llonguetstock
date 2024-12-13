<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Inertia\Inertia;

class CategoriaController extends Controller
{
    public function show($id)
{
    $category = Category::with('products')->findOrFail($id);

    return Inertia::render('CategoriaShow', [
        'category' => $category
    ]);
}

}
