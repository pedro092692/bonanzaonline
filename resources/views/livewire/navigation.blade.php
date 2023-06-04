<header class="bg-gray-700 sticky top-0" style="z-index: 900" x-data="dropdown()">
    <div class="container flex items-center h-16 justify-between md:justify-start">
        <!-- Hamburger -->
        <a  
            :class="{ 'bg-opacity-100 text-green-700' : open }"
            x-on:click="show()"
            class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-white bg-opacity-25 text-white cursor-pointer font-bold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="text-sm hidden md:block">Categorías</span>
        </a>
        
        {{-- logo --}}
        <a href="/" class="mx-4">
            <img src="{{ asset('images/bonanza_online_market.png') }}" alt="logo" class="block h-12 w-auto">
        </a>
        {{-- search --}}
        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>
        {{-- user --}}
        <div class="mx-4 relative hidden md:block">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            @if (auth()->user()->external_auth == 'google' && auth()->user()->profile_photo_path == "" )
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->avatar }}"
                                alt="{{ Auth::user()->name }}" />
                            @else
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                            @endif
                            
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="{{ route('orders.index') }}">
                            Mis Ordenes
                        </x-dropdown-link>

                        @role('admin')
                            <x-dropdown-link href="{{ route('admin.orders.index') }}">
                                Administrar
                            </x-dropdown-link>
                        @endrole

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            @endauth
        </div>
        {{-- cart --}}
        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>

        {{-- shopping cart movil--}}
        <div class="block md:hidden">
            @livewire('cart-mobil')
        </div>

    </div>

    <nav
        id="navigation-menu" 
        :class="{ 'block': open, 'hidden': !open }"
        class="bg-gray-700 bg-opacity-25 w-full absolute hidden">
        {{-- desktop menu --}}
        <div class="container h-full hidden md:block">
            <div 
                x-show="open" x-on:click.away="close()"
                class="grid grid-cols-4 h-full relative">
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="navigation-link tex-gray-500 hover:bg-green-600 hover:text-white">
                            <a href="{{route('categories.show', $category)}}" class="py-2 px-4 text-md flex items-center">
                                <span class="flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>
                                {{ $category->name }}
                            </a>

                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category" />
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="col-span-3 bg-gray-100">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>
            </div>
        </div>

        
       
        {{-- mobile menu --}}

        <div class="bg-white h-full overflow-y-auto">

            {{-- search --}}  
            <div class="container  bg-gray-100 py-4 mb-2">
                @livewire('search')
            </div> 

            

            {{-- my orders --}}
            @auth
                <a href="{{ route('orders.index') }}" class="py-2 px-4 text-md flex items-center tex-gray-500 hover:bg-green-600 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fa-solid fa-list"></i>
                    </span>
                    Mis ordenes
                </a>
            @endauth
            
            <p class="text-gray-500 px-6 my-2">Categorías</p>
                
            <ul>
                @foreach ($categories as $category)
                    <li class="tex-gray-500 hover:bg-green-600 hover:text-white">
                        <a href="{{route('categories.show', $category)}}" class="py-2 px-4 text-md flex items-center">
                            <span class="flex justify-center w-9">
                                {!! $category->icon !!}
                            </span>
                            {{ $category->name }}
                        </a>

                        <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                            <x-navigation-subcategories :category="$category" />
                        </div>
                    </li>
                @endforeach
            </ul>

            <p class="text-gray-500 px-6 my-2">Usuario</p>
            
            @auth
                <a href="{{route('profile.show')}}" class="py-2 px-4 text-md flex items-center tex-gray-500 hover:bg-green-600 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fa-solid fa-address-card"></i>
                    </span>
                    Perfil
                </a>
                <a href="" 
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit() "
                    class="py-2 px-4 text-md flex items-center tex-gray-500 hover:bg-green-600 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                    Cerrar Sesión 
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{route('login')}}" class="py-2 px-4 text-md flex items-center tex-gray-500 hover:bg-green-600 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    Iniciar Sesión
                </a>
                <a href="{{route('register')}}" class="py-2 px-4 text-md flex items-center tex-gray-500 hover:bg-green-600 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fa-solid fa-fingerprint"></i>
                    </span>
                    Registrarse
                </a>
            @endauth
        </div>
    </nav>
</header>


