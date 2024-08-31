<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@latest/src/index.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    <title>CRM & Real Estate</title>
    @stack('styles')
</head>

<body class="antialised">
    <header>
        <div class="w-full bg-[#333333] text-white">
            <div class="container mx-auto hidden md:flex justify-between items-center py-3">
                <div>
                    <a href="#">Post A Property</a>
                </div>
                <div>
                    <ul class="flex justify-between items-center gap-5">
                        @auth
                            <li>
                                <a href="account-dashboard">
                                    <i class="fas fa-th-large"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        @endauth
                        @guest
                            <li>
                                <a href="login">
                                    <i class="fa fa-lock"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span>Register</span>
                                </a>
                            </li> --}}
                        @endguest
                        <li>
                            <a href="#">
                                <i class="fa fa-home"></i>
                                <span>My Properties</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="bg-[#1A1111]" x-data="{ sidebar: false }">
            <div class="container mx-auto flex justify-between items-center py-3">
                <div>
                    <a href="/">
                        <img width="180" src="https://equi.co.in/Grocery/assets/images/logoIcon/logo.png"
                            alt="">
                    </a>
                </div>
                <div x-cloak x-show="sidebar" x-transition:enter="ease-in" x-transition:enter-start="-right-full"
                    x-transition:enter-end="right-0" x-transition:leave="ease-out" x-transition:leave-start="right-0"
                    x-transition:leave-end="-right-full"
                    class="fixed transition-all duration-300 grid place-items-center top-0 z-10 bg-[#333333] w-full sm:w-1/2 h-full p-4 ">
                    <button type="button" x-on:click="sidebar = false"
                        class="text-lg text-white absolute top-8 right-8 z-30"><i class="fa fa-times"></i></button>
                    <ul
                        class="flex jusify-center flex-col py-6 space-y-8 items-center text-[#777] font-bold uppercase text-sm">
                        <li><a href="/sell"
                                class="transition duration-300 hover:text-[#ccc] {{ request()->is('sell') ? 'text-[#ccc]' : '' }}">Sell</a>
                        </li>
                        <li><a href="/rent"
                                class="transition duration-300 hover:text-[#ccc] {{ request()->is('rent') ? 'text-[#ccc]' : '' }}">Rent</a>
                        </li>
                        <li><a href="/wanted"
                                class="transition duration-300 hover:text-[#ccc] {{ request()->is('wanted') ? 'text-[#ccc]' : '' }}">Wanted</a>
                        </li>
                        <li><a href="/commercial"
                                class="transition duration-300 hover:text-[#ccc] {{ request()->is('commercial') ? 'text-[#ccc]' : '' }}">Commertial</a>
                        </li>
                        <li><a href="/property-agent" class="transition duration-300 hover:text-[#ccc]">Agents</a></li>
                        <li><a href="#" class="transition duration-300 hover:text-[#ccc]">Post A Property</a></li>
                        <li><a href="/login" class="transition duration-300 hover:text-[#ccc]">Login</a></li>
                        {{-- <li><a href="/register" class="transition duration-300 hover:text-[#ccc]">Register</a></li> --}}
                        <li><a href="#" class="transition duration-300 hover:text-[#ccc]">My Property</a></li>
                    </ul>

                </div>
                <ul class="hidden md:flex items-center gap-6 text-[#777] font-bold uppercase text-sm">
                    <li><a href="/sell"
                            class="transition duration-300 hover:text-[#ccc] {{ request()->is('sell') ? 'text-[#ccc]' : '' }}">Sell</a>
                    </li>
                    <li><a href="/rent"
                            class="transition duration-300 hover:text-[#ccc] {{ request()->is('rent') ? 'text-[#ccc]' : '' }}">Rent</a>
                    </li>
                    <li><a href="/wanted"
                            class="transition duration-300 hover:text-[#ccc] {{ request()->is('wanted') ? 'text-[#ccc]' : '' }}">Wanted</a>
                    </li>
                    <li><a href="/commercial"
                            class="transition duration-300 hover:text-[#ccc] {{ request()->is('commercial') ? 'text-[#ccc]' : '' }}">Commercial</a>
                    </li>
                    <li><a href="/property-agent"
                            class="transition duration-300 hover:text-[#ccc] {{ request()->is('property-agent') ? 'text-[#ccc]' : '' }}">Agents</a>
                    </li>
                </ul>
                <button type="button" x-on:click="sidebar = true"
                    class="mx-3 text-lg border md:hidden border-white px-3 py-1 rounded text-white"><i
                        class="fa fa-bars"></i></button>
            </div>
        </nav>
    </header>
    <main>

        @yield('content')
    </main>
    <footer class="w-full">
        <div class="flex lg:flex-row flex-col container mx-auto">
            <div class="w-3/4 p-4 px-16">
                <h1 class="font-bold py-3">UseFul Links</h1>
                <div class="flex flex-col gap-y-5 lg:gap-y-0 lg:flex-row justify-between text-sm">
                    <ul class="space-y-2">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Help & Support</a></li>
                    </ul>
                    <ul class="space-y-2">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Help & Support</a></li>
                    </ul>
                    <ul class="space-y-2">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Help & Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="1/4 py-4 px-8">
                <h1 class="font-bold py-3">Social Links</h1>
                <div>
                    <a href="#" class="text-2xl text-gray-600">
                        <i class="fab fa-facebook-square"></i>
                        <i class="fab fa-twitter-square"></i>
                        <i class="fab fa-linkedin"></i>
                        <i class="fab fa-google-plus-square"></i>
                        <i class="fab fa-pinterest-square"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="py-5 text-center bg-gray-300">
            <p class="text-sm text-gray-600">Copyright &copy; {{ now()->format('Y') }} ECS.All rights are reserved
            </p>
        </div>
    </footer>
    @stack('scripts')
</body>

</html>
