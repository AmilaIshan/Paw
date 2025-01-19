<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paws</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex font-primary flex-col min-h-screen bg-gray-100 dark:bg-zinc-700">
    @include('user_components.header')
    <main class="flex-grow relative">
        <div class="relative h-[80vh] w-full">
            <img  
                src="{{ asset('images/banner.png') }}" 
                class="w-full h-full object-cover"
                alt="">
            
            <div class="absolute top-1/2 left-0 transform -translate-y-1/2 text-left pl-10">
                <h1 class="text-5xl font-bold mb-4 text-white drop-shadow-lg">Welcome to Paws</h1>
                <p class="text-xl text-white drop-shadow-md">Discover all what you needs for your furry friends at Paws</p>
            </div>
        </div>
        
        {{-- Category Section --}}
        <livewire:category />

        {{-- Recommended Products Section --}}
        <livewire:recommended-products/>


        <h3 class="text-center mt-10 font-bold text-[32px] ">Why Choose Us?</h3>
        <hr> 
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-10 mb-48 justify-items-center ">

            <div class="w-[300px] h-[400px] bg-white shadow-orange leading-7 p-4 rounded-md flex flex-col items-center text-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="orange" class="size-32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="text-lg font-bold mb-6">Quality & Healthy Food</h3>
                <p>
                    We offer premium, expert approved pet foods made with high-quality ingredients. Our selection 
                    emphasizes wholesome, balanced nutrition to support your pet's health and vitality at every 
                    life stage.
                </p>
            </div>


            <div class="w-[300px] h-[400px] bg-white shadow-orange leading-7 p-4 rounded-md flex flex-col items-center text-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="orange" class="size-32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>

                    <h3 class="text-lg font-bold mb-6">Free Shipping</h3>
                    <p>
                    We offer premium, expert approved pet foods made with high-quality ingredients.
                    Our selection emphasizes wholesome, balanced nutrition to support your pet's health
                    and vitality at every life stage.
                    </p>
            </div>

            <div class="w-[300px] h-[400px] bg-white shadow-orange leading-7 p-4 rounded-md flex flex-col items-center text-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="orange" class="size-32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.99 14.993 6-6m6 3.001c0 1.268-.63 2.39-1.593 3.069a3.746 3.746 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043 3.745 3.745 0 0 1-3.068 1.593c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.297 3.746 3.746 0 0 1-1.593-3.068c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 0 1 1.043-3.297 3.745 3.745 0 0 1 3.296-1.042 3.745 3.745 0 0 1 3.068-1.594c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.297 3.746 3.746 0 0 1 1.593 3.068ZM9.74 9.743h.008v.007H9.74v-.007Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                    <h3 class="text-lg font-bold mb-6">Value & Savings</h3>
                    <p>
                    We offer competitive pricing on top-quality pet foods. Our bulk buying options, 
                    loyalty program, monthly subscription program, and promotions help you save money 
                    while ensuring your pets get the best nutrition.
                    </p>
            </div>

            <div class="w-[300px] h-[400px] bg-white shadow-orange leading-7 p-4 rounded-md flex flex-col items-center text-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="orange" class="size-32">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
                    <h3 class="text-lg font-bold mb-6">Quality Guaranteed</h3>
                    <p>
                    We offer premium, expert approved pet foods made with high-quality ingredients. 
                    Our selection emphasizes wholesome, balanced nutrition to support your pet's 
                    health and vitality at every life stage.
                    </p>
            </div>
            
            
            
        </div>

    </main>
    @include('user_components.footer')
    @livewireScripts
</body>
</html>