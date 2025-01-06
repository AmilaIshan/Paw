<header class="flex bg-white dark:bg-zinc-800 items-center justify-between py-3 border-b border-gray-200 dark:border-gray-800">
    <div class="ml-10 flex">
        <a href="{{ route('home') }}">
            <p class="text-2xl font-bold ml-11 dark:text-white">Paws</p>
        </a>
        
    </div>
    <div class="flex mr-10">
        <div class="mr-12 ">
            <ul class="hidden md:flex font-bold space-x-6 dark:text-yellow-500  text-2xl capitalize cursor-pointer">
               <a href="{{ route('home') }}"><li >Home</li></a>
               <a href="{{ route('cart') }}"> <li>Cart</li></a>
                <li>Subscription</li>
                <li>About Us</li>
            </ul>
        </div>
        @guest
            <div class="flex space-x-4">
                <a class="flex space-x-2 items-center bg-yellow-300 px-6 rounded-sm hover:text-orange-700 text-sm text-gray-500"
                href="http://127.0.0.1:8000/login">
                Login
                </a>
                <a class="flex space-x-2 items-center bg-yellow-300 px-6 rounded-sm hover:text-orange-700 text-sm text-gray-500"
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
</header>