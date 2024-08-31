@extends('layouts.frontend')
@section('content')
<section class="flex gap-x-4 justify-center p-6">
    <div>
        <div class="bg-gray-200 p-3 space-y-2">
            <h1 class="text-3xl font-semibold">{{ $pro->title }}</h1>
            <p>From &#8377;{{ number_format($pro->price) }}</p>
        </div>
        <div class="p-2 border border-gray-300">
            <img src="{{ asset('photo/'.$pro->photo) }}" alt="">
        </div>
        <div>
            <h1 class="py-2 text-4xl font-semibold text-gray-400">Property Overview</h1>
            <div class="py-2 flex items-center flex-wrap">
                @if(($pro->amenities) > 0)
                @foreach ($pro->amenities as $item)  
                <div class="text-sm font-semibold text-[#59C517] p-1 space-x-1">
                    <i class="fas fa-check"></i>
                    <span class="text-gray-900">{{ \App\Models\PropertyAmenity::findOrFail($item)->name }}</span>
                </div>
                @endforeach
                @else
                <p>No amenities</p>
                @endif
            </div>
        </div>
    </div>
    <div>
        <div class="w-[350px]">
            <div class="bg-green-500 text-white">
                <h1 class="p-2 text-lg font-semibold">Marketed By</h1>
            </div>
            <div class="border border-gray-400 p-3">
                <div class="flex justify-between">
                    <img class="h-20" src="https://www.caspianpolicy.org/no-image.png" alt="">
                    <div class="space-y-3">
                        <p class="px-2">Abc Agency</p>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 border border-gray-300">Details</button>
                            <button class="px-3 py-1 border border-gray-300">Contact</button>
                        </div>
                    </div>
                </div>
                <div class="pt-4 px-3">
                    <p class="text-sm font-medium text-gray-500 space-x-1">
                        <i class="fa fa-map-marker-alt"></i>
                        <span>{{ $pro->location }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="border border-gray-400 my-4 text-[#59C517]">
            <a href="#" class="px-4 py-2 block border-b border-gray-400 space-x-2">
                <i class="fas fa-heart"></i>
                <span class="text-sm font-semibold">Add To Favourite</span>
            </a>
            <a href="#" class="px-4 py-2 block border-b border-gray-400 space-x-2">
                <i class="fas fa-print"></i>
                <span class="text-sm font-semibold">Print This Page</span>
            </a>
            <a href="#" class="px-4 py-2 block space-x-2">
                <i class="fas fa-envelope"></i>
                <span class="text-sm font-semibold">Email A Friend</span>
            </a>
        </div>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117925.2168964898!2d88.26495019273595!3d22.53556493752324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1725025808008!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
@endsection