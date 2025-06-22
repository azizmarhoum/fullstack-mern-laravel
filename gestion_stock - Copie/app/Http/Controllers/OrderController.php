<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $status = request('status'); // Get selected status from URL

        $orders = Order::with('client', 'products')
            ->when($status, fn($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Show order creation form
    public function create()
    {
        $clients = Client::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('orders.create', compact('clients', 'products'));
    }

    // Store a new order
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products.id' => 'required|array',
            'products.id.*' => 'required|exists:products,id',
            'products.quantity' => 'required|array',
            'products.quantity.*' => 'required|integer|min:1',
        ]);

        // Calculate total price and check stock
        $totalPrice = 0;
        $orderProducts = [];

        foreach ($request->products['id'] as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->products['quantity'][$index];

            // Check stock
            if ($product->stock < $quantity) {
                return back()->with('error', "Insufficient stock for {$product->name}!");
            }

            $orderProducts[$product->id] = [
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'total_price' => $product->price * $quantity,
            ];

            $totalPrice += $product->price * $quantity;
        }

        // Rest of your store method remains the same...
        $order = Order::create([
            'client_id' => $request->client_id,
            'order_date' => now(),
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        $order->products()->attach($orderProducts);

        foreach ($request->products['id'] as $index => $productId) {
            Product::where('id', $productId)->decrement('stock', $request->products['quantity'][$index]);
        }

        return redirect()->route('orders.index')->with('success', 'Order placed!');
    }

    // Show a single order
    public function show(Order $order)
    {
        $order->load('client', 'products');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    // Update order status (e.g., confirm/cancel)
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        // If cancelling, restore stock
        if ($request->status === 'cancelled' && $order->status !== 'cancelled') {
            foreach ($order->products as $product) {
                $product->increment('stock', $product->pivot->quantity);
            }
        }

        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Order updated!');
    }

    // Delete an order (with stock restoration)
    public function destroy(Order $order)
    {
        if ($order->status !== 'cancelled') {
            foreach ($order->products as $product) {
                $product->increment('stock', $product->pivot->quantity);
            }
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted!');
    }

    public function downloadPdf(Order $order)
    {
        $pdf = Pdf::loadView('orders.pdf', compact('order'));
        return $pdf->download("commande-{$order->id}.pdf");
    }
}
