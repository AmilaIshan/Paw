<x-app-layout>
    <div class="lg:grid lg:grid-cols-2 mx-auto max-w-[1200px] h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">

        <div class="flex items-center justify-center">
            <img 
                    class="mb-4 w-full lg:h-96 h-48 max-w-2xl mx-auto object-contain"
                    src="{{ asset('storage/' . $product->image_url[0]) }}"
                    alt="{{ $product->product_name }}"
                />
        </div>
        <div class="flex items-center justify-center">
            <div class="">
                
                <h1 class="m-2 font-bold text-2xl">{{ $product->product_name }}</h1>
                <div>
                    <p class="m-2 text-2xl font-bold text-gray-900">Rs. {{ number_format($product->price, 2) }}</p>
                </div>
                <div class="mt-6">
                    <p class="m-3 mb-6 text-gray-500">{{ $product->description }}</p>
                    
                    @if($product->additional_info)
                        <p class="m-3 text-gray-500">{{ $product->additional_info }}</p>
                    @endif
                </div>

                <div class="flex space-x-4 mb-4">
                    {{-- <button class="mx-4 my-2 w-64 rounded-md border-2 bg-blue-900 px-4 py-1 text-white hover:bg-blue-800 transition">
                        Add to Cart
                    </button> --}}

                    {{-- @if (session('message'))
                       <span class="w-100 py-3 bg-green-300"> {{ session('message') }} </span>
                    @endif --}}
                    
                    <div x-data="{ message: '' }" @authError.window="message = $event.detail">
                        <template x-if="message">
                            <span class="w-full py-3 bg-green-300" x-text="message"></span>
                        </template>
                    </div>
                   
                    @livewire('add-to-cart-button', ['productId' => $product->id])

                    <button class="mx-4 my-2 w-64 rounded-md border-2 bg-blue-900 px-4 py-1 text-white hover:bg-blue-800 transition">
                        Buy Now
                    </button>
                </div>
                {{-- <hr class="mx-4 border-gray-400" /> --}}
                
               
            </div>
           
        </div>
    </div>
</x-app-layout>