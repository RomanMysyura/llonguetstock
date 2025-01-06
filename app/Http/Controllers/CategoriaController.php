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
public function getallcategories()
{
    $categories = Category::with('products')->get();
    return response()->json($categories);
}



public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        $imagePath = $request->file('image')->store('img', 'public');

        
        $category = Category::create([
            'name' => $request->name,
            'imageurl' => '/storage/' . $imagePath
        ]);

        return response()->json(['message' => 'Categoría creada con éxito', 'category' => $category]);
    }

}
