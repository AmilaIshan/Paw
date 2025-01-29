<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();
        return CartResource::collection($cart);
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

        $cart = Cart::create([
            'product_id' => $validated['product_id'],
            'user_id' => $validated['user_id'],
            'quantity' => $validated['quantity'],
            'price' => $product->price,
        ]);

        $cart->save();

        return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Cart::findOrFail($id);
        return new CartResource($cart);
    }

    public function cartPage()
    {

        // Get authenticated user's cart items with product details
        // $cartItems = Cart::with('product')
        //     ->where('user_id', Auth::id())
        //     ->get();

        // Calculate total cost
        // $totalCost = $cartItems->sum(function ($item) {
        //     return $item->price * $item->quantity;
        // });
        $token = null;
        if (auth()->check()) {
            $token = auth()->user()->createToken('cart-access')->plainTextToken;
        }

        return view('cart.index', ['token' => $token]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cart = Cart::where('product_id', $productId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    
        $cart->update([
            'quantity' => $request->quantity
        ]);
    
        return response()->json(['message' => 'Cart updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cartId)
    {
        Cart::where('id', $cartId)->delete();
        return response()->json(['message' => 'Product removed from cart']);
    }
}
