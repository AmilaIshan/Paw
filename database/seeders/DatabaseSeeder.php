<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use App\Models\Transaction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
        $categories = Category::factory(5)->create();

         $user = User::factory(10)->create();

         $admin = Admin::factory(3)->create();

        $product = Product::factory(10)->create()->each(function ($product){
            // $product->category_id = $categories->random()->id;
            // $product->save();

            Image::factory(rand(1, 3))->create([
                'product_id' => $product->id,
            ]);
        });


        Transaction::factory(20)->create();
        
        Cart::factory(5)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
