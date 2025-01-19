<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen flex flex-col">
        <x-banner />

        <div class="flex-grow min-h-screen bg-gray-100 dark:bg-zinc-700">
          
            @include('user_components.header')
            
            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            @include('user_components.footer')



        </div>

        @stack('modals')

        @livewireScripts
        <script>
            window.addEventListener('removeFromcart', (event) => {
                let data = event.detail;
                let itemId = data.itemId;
                console.log(data);
                Swal.fire({
                    icon: data.title,
                    iconColor: '#ff2424',
                    title: data.message,
                    showCancelButton: true,
                    confirmButtonText: "Remove",
                    confirmButtonColor: '#ff3636',
                    cancelButtonColor: '#28e506',
                }).then((result) => {
                    if (result.isConfirmed) {
                        //Livewire.dispatch('remove-from-cart');
                        //Livewire.emit('remove-from-cart', { itemId: data.itemId });
                        Livewire.dispatch('remove-from-cart', { itemId: data.itemId });
                    }
                });
            });
        </script>
        
    </body>
    
</html>
