<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-zinc-700">
    @include('user_components.header')
    <main class="flex-grow relative">
        <div class="relative h-[80vh] w-full">
            <img  
                src="https://t3.ftcdn.net/jpg/06/96/91/04/360_F_696910475_p7XUMWNKjVpsn9ok9wJtTpTEgMBB4zjC.jpg" 
                class="w-full h-full object-cover"
                alt="">
            
            <div class="absolute top-1/2 left-0 transform -translate-y-1/2 text-left pl-10">
                <h1 class="text-5xl font-bold mb-4 text-white drop-shadow-lg">Welcome to Our Website</h1>
                <p class="text-xl text-white drop-shadow-md">Discover amazing things with us</p>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <h1 class="dark:text-white m-10 text-2xl">Categories</h1>
            
        </div>
        {{-- <div class="flex justify-center items-center space-x-20">
            <div>
                <div class="h-[150px] w-[150px] rounded-full m-2 bg-white"></div>
                <p class="text-center">This Category 1</p>
            </div>
            <div>
                <div class="h-[150px] w-[150px] rounded-full m-2 bg-white"></div>
                <p class="text-center">This Category 2</p>
            </div>
            <div>
                <div class="h-[150px] w-[150px] rounded-full m-2 bg-white"></div>
                <p class="text-center">This Category 3</p>
            </div>
            
        </div> --}}
        <livewire:category />
        <livewire:recommended-products/>
    </main>
    @include('user_components.footer')
</body>
</html>