<div class=" mx-auto max-w-[1200px] min-h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">
    <div class="flex items-center justify-between h-full">
        <div class="w-full max-w-[1200px]">

                <div class="flex flex-col justify-between h-full">
                    @foreach ($cartItems as $item)
                    <div class="max-w-[1200px] h-[180px] bg-white rounded-lg shadow-lg p-6 m-10">
                        <div class="flex justify-between items-center">
                            <div class="m-4">
                                <img class="w-full h-32 m-4 object-contain" src="{{ asset('storage/' . $item->product->image_url[0] ) }}" alt="">
                            </div>
                            <div class="w-[400px]">
                                <p>{{ $item->product->product_name }}</p>
                            </div>
                            <div>
                                <p>Rs. {{ $item->price }}</p>  
                            </div>
                            <div class="flex">
                                @livewire('cart-quantity', ['item' => $item])
                            </div>
                            <div>
                                {{-- <button type="button" class="bg-red-400 p-2 rounded-md">Remove Item</button> --}}
                                {{-- @livewire('remove-cart-item', ['cartId' => $item->id], key('remove-' . $item->id . '-' . $loop->index)) --}}
                                @livewire('remove-cart-item', ['cartId' => $item->id], key($item->id))
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    {{-- Cart Cost section --}}
                    @livewire('cart-cost')
                </div>
        </div>
    
    </div>
</div>
