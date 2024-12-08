<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::with('user', 'product')->paginate(5);
        return TransactionResource::collection($transaction);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'product_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        
        $transaction = Product::create([
            'product_id' => $validated['product_id'],
            'user_id' => $validated['user_id'],
            'quantity' => $validated['quantity'],
            'price' => $product->price,
        ]);

        $transaction->save();

        return new TransactionResource($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'price' => 'integer',
            'quantity' => 'integer',
            'product_id' => 'integer',
            'user_id' => 'integer'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
    }
}
