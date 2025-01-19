<div>
    <div class="flex justify-center items-center space-x-20">
        <h1 class="m-4 mt-32 ml-5 text-3xl font-bold mb-24">Recommend Products</h1>
    </div>
    
    <div class="flex justify-center items-center space-x-20">
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-10 mb-48 justify-items-center">
            @foreach ($products as $product)
           
                <div class="bg-white w-[300px] h-[400px] cursor-pointer shadow-lg rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                   
                    <a href="{{ route('products.show', $product) }}">
                        <img class="w-full h-48 m-4 object-contain" src="{{ asset('storage/' . $product->image_url[0]) }}" alt="Product Image">
                        <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $product->product_name }}</h3>
                        <p class="text-gray-600 text-lg">Rs. {{ $product->price }}</p>
                        <p class="text-gray-700 mt-2 mb-2">Brief description of the product...Brief description of the product...Brief description of the product...</p>
                        
                    </a>    
                    {{-- <button class="mt-4 w-full bg-yellow-400 text-white px-4 py-2 rounded-lg">Add to Cart</button> --}}
                    
                    @livewire('add-to-cart-button', ['productId' => $product->id])
                    </div>
                </div>
           
            @endforeach
        </div>
    </div>
    
   

</div>

