<x-app-layout>
    <div class=" mx-auto max-w-[1200px] min-h-[600px] bg-white rounded-lg shadow-lg p-6 m-10">
        @guest
            <div class="flex items-center justify-center">
        
                <div class="flex flex-col justify-center items-center">
                    <div class="text-2xl m-4">
                        <h2>Login or Register to view the cart</h2>
                    </div>
                    <div class="flex space-x-4">
                        <a class=" space-x-2 p-2 w-48 text-center  bg-yellow-300 px-6 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                        href="http://127.0.0.1:8000/login">
                        Login
                        </a>
                        <a class="space-x-2 w-48 p-2 text-center bg-yellow-300 px-6 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                            href="http://127.0.0.1:8000/register">
                            Register
                        </a>
                    </div>

                </div>
                        
                    
            </div>
        @endguest
        @auth
            <div class="flex items-center justify-between h-full">
                <div class="w-full max-w-[1200px]">

                        <div class="flex flex-col justify-between h-full">
                            @foreach ($cartItems as $item)
                            <div class="max-w-[1200px] h-[150px] bg-white rounded-lg shadow-lg p-6 m-10">
                                <div class="flex justify-between items-center">
                                    <div class="w-32 h-32 bg-green-300"></div>
                                    <div class="w-[400px]">
                                        <p>{{ $item->product->product_name }}</p>
                                    </div>
                                    <div>
                                        <p>Rs. {{ $item->price }}</p>
                                    </div>
                                    <div class="flex">
                                        {{-- <button class="p-2" type="button">-</button>
                                        <p class="p-2">1</p>
                                        <button class="p-2"  type="button">+</button> --}}
                                        @livewire('cart-quantity', ['item' => $item])
                                    </div>
                                    <div>
                                        <button type="button" class="bg-red-400 p-2 rounded-md">Remove Item</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            {{-- <div class="max-w-[1200px] h-[150px] bg-white rounded-lg  p-6 m-10 mt-auto">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-2xl">Total Cost</p>
                                    </div>
                                    <div>
                                        <p>{{ $totalCost }}</p>
                                    </div>
                                </div>
                                <div class="flex mt-12">
                                    <button class="ml-auto bg-yellow-400 py-2 px-4 w-48 rounded-md">Check Out</button>
                                </div>
                                
                            </div> --}}
                            @livewire('cart-cost')
                        </div>
                </div>
            
            </div>
        @endauth
    </div>
</x-app-layout>