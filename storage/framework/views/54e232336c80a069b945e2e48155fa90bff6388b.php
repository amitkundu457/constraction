<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <title>CRM & Real Estate</title>
</head>

<body>
    <div>
        <header class="w-full bg-[#333333] text-white">
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
        </header>
        <nav class="bg-[#1A1111]">
            <div class="container mx-auto flex justify-between items-center py-3">
                <div>
                    <a href="#">
                        <img width="180" src="https://equi.co.in/Grocery/assets/images/logoIcon/logo.png" alt="">
                    </a>
                </div>
                <ul class="flex items-center gap-5">
                    <li><a href="#">Sell</a></li>
                    <li><a href="#">Rent</a></li>
                    <li><a href="#">Wanted</a></li>
                    <li><a href="#">Commertial</a></li>
                    <li><a href="#">Agents</a></li>
                </ul>
            </div>
        </nav>
    </div>
</body>

</html>
<?php /**PATH E:\laragon\www\construction\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>