<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // List all purchases
    public function index()
    {
        $purchases = Purchase::with('product')->latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    // Show purchase creation form
    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    // Store a new purchase
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
        ]);

        $totalCost = $request->quantity * $request->unit_cost;

        Purchase::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_cost' => $request->unit_cost,
            'total_cost' => $totalCost,
            'purchase_date' => now(),
        ]);

        // Update product stock
        Product::where('id', $request->product_id)->increment('stock', $request->quantity);

        return redirect()->route('purchases.index')->with('success', 'Purchase recorded!');
    }

    // Show a single purchase
    public function show(Purchase $purchase)
    {
        $purchase->load('product');
        return view('purchases.show', compact('purchase'));
    }

    // Show purchase edit form
    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        return view('purchases.edit', compact('purchase', 'products'));
    }

    // Update a purchase
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
        ]);

        // Calculate the difference in quantity
        $quantityDiff = $request->quantity - $purchase->quantity;
        $totalCost = $request->quantity * $request->unit_cost;

        // Update the purchase record
        $purchase->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_cost' => $request->unit_cost,
            'total_cost' => $totalCost,
        ]);

        // Update product stock
        if ($quantityDiff != 0) {
            Product::where('id', $request->product_id)
                  ->increment('stock', $quantityDiff);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase updated!');
    }

    // Delete a purchase (reverse stock update)
    public function destroy(Purchase $purchase)
    {
        Product::where('id', $purchase->product_id)->decrement('stock', $purchase->quantity);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted!');
    }
}