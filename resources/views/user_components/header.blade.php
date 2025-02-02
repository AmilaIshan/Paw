<header class="flex bg-white h-18 dark:bg-zinc-800 items-center justify-between py-2 border-b border-gray-200 dark:border-gray-800 font-primary">
    <div class="ml-10 flex">
        <!-- <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-5 h-5 rounded-full">
            <p class="text-2xl font-bold ml-11 dark:text-white">Paws</p>
        </a> -->
        <div class="ml-10 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 rounded-full">
                <p class="text-2xl font-bold dark:text-white">Paws</p>
            </a>
        </div>

        <ul class="hidden md:flex space-x-14 dark:text-yellow-500 ml-10 text-base capitalize cursor-pointer items-center mr-4">
            <li></li>
            <a class="{{ request()->routeIs('home') ? 'border-b-2 border-yellow-500' : '' }}" href="{{ route('home') }}">
                <li>Home</li>
            </a>
            <a class="{{ request()->routeIs('cart') ? 'border-b-2 border-yellow-500' : '' }}" href="{{ route('cart') }}">
                <li>Cart</li>
            </a>
            <a class="{{ request()->routeIs('subscription') ? 'border-b-2 border-yellow-500' : '' }}" href="{{ route('subscription') }}">
                <li>Subscription</li>
            </a>
            <a class="{{ request()->routeIs('aboutUs') ? 'border-b-2 border-yellow-500' : '' }}" href="{{ route('aboutUs') }}">
                <li>About Us</li>
            </a>
        </ul>
    </div>
    <div class="flex mr-10">
        
            <!-- <ul class="hidden md:flex space-x-14 dark:text-yellow-500 text-base capitalize cursor-pointer items-center mr-4">
               <a class="" href="{{ route('home') }}"><li >Home</li></a>
               <a class="" href="{{ route('cart') }}"> <li>Cart</li></a>
                <a class="" href="{{ route('subscription') }}"><li>Subscription</li></a>
                <a class="" href="{{ route('aboutUs') }}"><li>About Us</li></a>
            </ul> -->
            <button class="mr-2" id="themeBtn">
                <svg id="moon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>
                <svg id="sun" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>
            </button>
            

        @livewire('search')
        @guest
            <div class="flex space-x-4 items-center justify-center">
                <a class="flex space-x-2 items-center bg-yellow-300 px-4 h-8 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                href="http://127.0.0.1:8000/login">
                Login
                </a>
                <a class="flex space-x-2 items-center bg-yellow-300 px-4 h-8 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                    href="http://127.0.0.1:8000/register">
                    Register
                </a>
            </div>
        @endguest
        
        @auth
        <div class="ms-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    @endif
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <x-dropdown-link href="{{ route('cart') }}">
                        {{ __('Cart') }}
                    </x-dropdown-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                    @endif

                    <div class="border-t border-gray-200"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}"
                                 @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        @endauth
        
    </div>

    <script >
        document.addEventListener('DOMContentLoaded', function() {
            const sunIcon = document.getElementById('sun');
            const moonIcon = document.getElementById('moon');
            const switchBtn = document.getElementById('themeBtn');
            const userTheme = localStorage.getItem("theme");
            const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

            switchBtn.addEventListener('click', () => {
                sunIcon.classList.toggle('hidden');
                moonIcon.classList.toggle('hidden');
                console.log('button clicked');
            });
        });

        
    </script>
</header>