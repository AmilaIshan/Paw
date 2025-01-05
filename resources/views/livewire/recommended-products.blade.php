<div>
    <h1 class="m-4 ml-5 text-5xl font-bold mb-24">Recommend Products</h1>
    
    <div class="grid md:mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 lg:gap-x-12 gap-y-20 p-4 mb-24">
        @foreach ($products as $product)
        <a href="{{ route('products.show', $product) }}">
            <div class="bg-white cursor-pointer shadow-lg rounded-lg overflow-hidden">
                <img class="w-full h-48 m-4 object-contain" src="{{ asset('storage/' . $product->image_url[0]) }}" alt="Product Image">
                <div class="p-4">
                <h3 class="text-2xl font-semibold">{{ $product->product_name }}</h3>
                <p class="text-gray-600 text-lg">Rs. {{ $product->price }}</p>
                <p class="text-gray-700 mt-2">Brief description of the product...</p>
                <button class="mt-4 w-full bg-yellow-400 text-white px-4 py-2 rounded-lg">Add to Cart</button>
                </div>
            </div>
         </a>
        @endforeach
    </div>

</div>

