<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Movement;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function changeproductquanity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'operation' => 'required|in:+,-',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $beforeValue = $product->quantity;

        if ($request->operation === '+') {
            $product->quantity += $request->quantity;
        } else {
            $product->quantity -= $request->quantity;
            if ($product->quantity < 0) {
                $product->quantity = 0; 
            }
        }

        $product->save();

        // Guardar el movimiento en la tabla movements
        Movement::create([
            'name' => $product->name,
            'beforevalue' => $beforeValue,
            'aftervalue' => $product->quantity
        ]);

        return response()->json(['success' => true, 'quantity' => $product->quantity]);
    }

    public function getallmovements(Request $request)
{
    $movements = Movement::orderBy('created_at', 'asc')->get()->map(function ($movement) {
        return [
            'name'         => $movement->name,
            'beforevalue'  => $movement->beforevalue,
            'aftervalue'   => $movement->aftervalue,
            // Para agrupar por día
            'date'         => $movement->created_at->format('Y-m-d'),
            // Para ordenar por fecha/hora exacta
            'datetime'     => $movement->created_at->format('Y-m-d H:i:s'),
        ];
    });

    return response()->json($movements);
}

public function unsignproduct(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $product = Product::findOrFail($request->product_id);
    $product->category_id = null;
    $product->save();

    return response()->json(['success' => true, 'message' => 'Producto desassignat.']);
}

public function createproduct(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'quantity' => 'required|integer',
        'category_id' => 'required|integer'
    ]);

    Product::create($validated);

    return response()->json(['message' => 'Producto creado']);
}


    
}
