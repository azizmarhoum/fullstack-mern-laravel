<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // List all clients
    public function index()
    {
        $clients = Client::latest()->get();
        return view('clients.index', compact('clients'));
    }

    // Show client creation form
    public function create()
    {
        return view('clients.create');
    }

    // Store a new client
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client created!');
    }

    // Show a single client
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    // Show client edit form
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Update a client
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client updated!');
    }

    // Delete a client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted!');
    }
}