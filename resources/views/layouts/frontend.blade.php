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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family:"Open Sans",sans-serif;
        }
    </style>
    <title>CRM & Real Estate</title>
</head>

<body>
    <header>
        <div class="w-full bg-[#333333] text-white">
            <div class="container mx-auto flex justify-between items-center py-3">
                <div>
                    <a href="#">Post A New Property</a>
                </div>
                <div>
                    <ul class="flex justify-between items-center gap-5">
                        <li>
                            <a href="#">
                                <i class="fa fa-lock"></i>
                                <span>Login</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Register</span>
                            </a>
                        </li>
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
        <nav class="bg-[#1A1111]">
            <div class="container mx-auto flex justify-between items-center py-3">
                <div>
                    <a href="#">
                        <img width="180" src="https://equi.co.in/Grocery/assets/images/logoIcon/logo.png"
                            alt="">
                    </a>
                </div>
                <ul class="flex items-center gap-6 text-[#777] font-bold uppercase text-sm">
                    <li><a href="#" class="transition duration-300 hover:text-[#ccc]">Sell</a></li>
                    <li><a href="#" class="transition duration-300 hover:text-[#ccc]">Rent</a></li>
                    <li><a href="#" class="transition duration-300 hover:text-[#ccc]">Wanted</a></li>
                    <li><a href="#" class="transition duration-300 hover:text-[#ccc]">Commertial</a></li>
                    <li><a href="#" class="transition duration-300 hover:text-[#ccc]">Agents</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="bg-[url('https://belfort.qodeinteractive.com/wp-content/uploads/2023/01/home-2-top-img.jpg')] min-h-[600px] w-full relative flex flex-col justify-center items-center">
            <div class="absolute flex flex-col items-center">
                <h1 class="text-[64px] font-normal text-white">Find Your Dream Property</h1>
                <p class="text-white text-lg tracking-[0.25em]">Lorem ipsum dolor sit amet, epicuri fierent mediocritatem nam et</p>
                <div>
                    <div>
                        <input type="radio" name="" id="">
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
