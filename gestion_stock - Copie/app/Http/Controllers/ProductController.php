<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Show product creation form
    public function create()
    {
        return view('products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product added!');
    }

    // Show a single product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show product edit form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}