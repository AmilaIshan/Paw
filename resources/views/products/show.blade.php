<x-app-layout>
    <div class="lg:grid lg:grid-cols-2 mx-auto max-w-[1200px] h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">


        <div class="flex items-center justify-center relative">
            <img 
                    class="mb-4 w-full lg:h-96 h-48 max-w-2xl mx-auto object-contain"
                    src="{{ asset('storage/' . $product->image_url[0]) }}"
                    alt="{{ $product->product_name }}"
            />

            <div class="absolute top-1/4 right-5">
                @livewire('favorite', ['productId' => $product->id])
            </div>
        </div>
        <div class="flex items-center justify-center p-2">
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
                    
                    <div x-data="{ message: '' }" @authError.window="message = $event.detail">
                        <template x-if="message">
                            <span class="w-full py-3 bg-green-300" x-text="message"></span>
                        </template>
                    </div>
                   
                    {{--  Add to Cart Button --}}
                    @livewire('add-to-cart-button', ['productId' => $product->id])


                    {{-- Buy Now Button --}}
                    @livewire('order', ['productId' => $product->id])

                    
                </div>
                {{-- <hr class="mx-4 border-gray-400" /> --}}
                
               
            </div>
           
        </div>
    </div>
</x-app-layout>