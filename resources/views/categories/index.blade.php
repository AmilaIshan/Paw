<x-app-layout>
    <div class="flex justify-center items-center">
        <div class="grid mx-32 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-12 gap-y-20 p-4 mb-24">
            @foreach ($items as $item)
            <a href="{{ route('products.show', $item) }}">
                <div class="bg-white cursor-pointer shadow-lg rounded-lg overflow-hidden">
                    <div class="flex justify-center items-center">
                        <img class="w-full h-48 m-4 object-contain" src="{{ asset('storage/' . $item->image_url[0]) }}" alt="Product Image">
                    </div>     
                    <div class="p-4">
                    <h3 class="text-2xl font-semibold">{{ $item->product_name }}</h3>
                    <p class="text-gray-600 text-lg">Rs. {{ $item->price }}</p>
                    <p class="text-gray-700 mt-2">Brief description of the product...</p>
                    <button class="mt-4 w-full bg-yellow-400 text-white px-4 py-2 rounded-lg">Add to Cart</button>
                    </div>
                </div>
             </a>
            @endforeach
        </div>
    </div>
    
</x-app-layout>