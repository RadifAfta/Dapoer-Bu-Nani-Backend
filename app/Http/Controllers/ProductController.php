<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        return response()->json(Product::all());
    }

    // Show single product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Create product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_image' => 'nullable|string',
            'product_price' => 'required|numeric',
            'product_description' => 'nullable|string',
        ]);

        $validated['id'] = (string) Str::uuid();

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'sometimes|required|string|max:255',
            'product_image' => 'nullable|string',
            'product_price' => 'sometimes|required|numeric',
            'product_description' => 'nullable|string',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
