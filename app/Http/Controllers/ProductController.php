<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category')->paginate(5);
        return ProductResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       

        $validate = $request->validate([
            'product_name' => 'required|string|max:50',
            'description' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'weight' => 'nullable|integer',
            'category_name' => 'required|string',
            'admin_id' => 'required|integer'
        ]);

        $category = Category::where('category_name',$request->input('category_name'))->first();
        if(!$category){
            return response()->json(['error' => 'Category not found'], 404);
        }

        $product = Product::create([
            'product_name' => $validate['product_name'],
            'description' => $validate['description'],
            'price' => $validate['price'],
            'quantity' => $validate['quantity'],
            'weight' => $validate['weight'],
            'category_id' => $category->id,
            'admin_id' => $validate['admin_id']
        ]);

        $product->save();

        return new ProductResource($product);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'product_name' => 'required|string|max:50',
            'description' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'weight' => 'nullable|integer',
            'category_name' => 'required|string',
            'admin_id' => 'required|integer'
        ]);

        $product = Product::findOrFail($id);
        $product->update($validate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully', 200]);
    }
}
