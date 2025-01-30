<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'product_id' => 'required|integer'
        ]);

        $validated['user_id'] = Auth::id();

        $product = Product::findOrFail($validated['product_id']);
        
        $transaction = Transaction::create([
            'product_id' => $validated['product_id'],
            'user_id' => $validated['user_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
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

    public function checkoutPage(){
        $token = null;
        if(auth()->check()){
            $token = auth()->user()->createToken('checkoutToken')->plainTextToken;

        }
        return view('checkout.checkout',['token' => $token]);
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
