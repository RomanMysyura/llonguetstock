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
}
