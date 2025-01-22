<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Http\Resources\FavoriteResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favorite = Favorite::all();
        return FavoriteResource::collection($favorite);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        
        $favorite = Favorite::create($validated);
        $favorite->save();

        return new FavoriteResource($favorite);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();
    }

    public function toggle(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);
        
        if ($user->favoriteProducts()->where('product_id', $productId)->exists()) {
            $user->favoriteProducts()->detach($productId);
            return response()->json(['liked' => false]);
        } else {
            $user->favoriteProducts()->attach($productId);
            return response()->json(['liked' => true]);
        }
    }

    public function check($productId)
    {
        $isLiked = Auth::user()->favoriteProducts()
            ->where('product_id', $productId)
            ->exists();
            
        return response()->json(['liked' => $isLiked]);
    }
}