<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-bold">{{ $category->category_name }}</h1>
        <div class="grid grid-cols-3 gap-4 mt-4">
            @foreach ($products as $product)
                <div class="border p-4 rounded">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->product_name }}" class="w-full h-48 object-cover">
                    <h2 class="mt-2 text-lg font-semibold">{{ $product->product_name }}</h2>
                    <p class="text-gray-600">{{ $product->price }} USD</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
