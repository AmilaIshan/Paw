<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::paginate(5);
        return CategoryResource::collection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string',
        ]);

        $category = Category::create($validated);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $cart = Cart::findOrFail($id);
        // return new CategoryResource($cart);
        // $category = Category::findOrFail($id);
        $items = Product::where('category_id', $id)->get();
        return ProductResource::collection($items);
        // $category = Category::with('products')->findOrFail($id);
        // return new CategoryResource($category);
    }

    public function getProducts($id)
    {
        return view('categories.category-products');
    }

    public function display($categoryId){
        
        $category = Category::findOrFail($categoryId);
        $items = Product::where('category_id', $categoryId)->get();
        return view('categories.index', compact('category', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|string',
        ]);
        $cart = Cart::findOrFail($id);
        $cart->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
    }
}
