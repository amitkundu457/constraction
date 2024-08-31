@extends('layouts.frontend')
@section('content')
    <section x-data="{ selected: 1 }"
        class="bg-[url('https://belfort.qodeinteractive.com/wp-content/uploads/2023/01/home-2-top-img.jpg')] bg-cover  min-h-[800px] sm:min-h-[600px] w-full relative flex flex-col justify-center items-center">
        <form :action="selected === 1 ? '/sell' : selected === 2 ? '/rent' : '/wanted'"
            class="absolute flex flex-col justify-center items-center w-full">
            <h1 class="text-[48px] sm:text-[52px] md:text-[56px] text-center lg:text-[64px] font-normal text-white">Find Your
                Dream Property</h1>
            <p class="text-white text-lg text-center sm:tracking-[0.25em]">Lorem ipsum dolor sit amet, epicuri fierent
                mediocritatem nam et</p>
            <div class="flex items-center gap-x-5 sm:gap-x-8 py-8">
                <div class="flex justify-center items-center gap-x-2" x-on:click="selected=1">
                    <div class="border-[3px] sm:border-[5px] rounded-full w-8 h-8 sm:w-12 sm:h-12 flex justify-center items-center relative"
                        :class="selected === 1 ?
                            'border-[#A7FE01] before:absolute before:w-4 before:h-4 before:sm:w-7 before:sm:h-7 before:bg-[#A7FE01] before:rounded-full' :
                            'border-white'">
                    </div>
                    <span class="font-medium text-lg" :class="selected === 1 ? 'text-[#A7FE01]' : 'text-white'">For
                        Sell</span>
                    <input type="radio" name="select" id="" :checked="selected === 1" value="sell"
                        class="hidden">
                </div>
                <div class="flex justify-center items-center gap-x-2" x-on:click="selected=2">
                    <div class="border-[3px] sm:border-[5px] rounded-full w-8 h-8 sm:w-12 sm:h-12 flex justify-center items-center relative"
                        :class="selected === 2 ?
                            'border-[#A7FE01] before:absolute before:w-4 before:h-4 before:sm:w-7 before:sm:h-7 before:bg-[#A7FE01] before:rounded-full' :
                            'border-white'">
                    </div>
                    <span class="font-medium text-lg" :class="selected === 2 ? 'text-[#A7FE01]' : 'text-white'">To
                        Rent</span>
                    <input type="radio" name="select" id="" :checked="selected === 2" value="rent"
                        class="hidden">
                </div>
                <div class="flex justify-center items-center gap-x-2" x-on:click="selected=3">
                    <div class="border-[3px] sm:border-[5px] rounded-full w-8 h-8 sm:w-12 sm:h-12 flex justify-center items-center relative"
                        :class="selected === 3 ?
                            'border-[#A7FE01] before:absolute before:w-4 before:h-4 before:sm:w-7 before:sm:h-7 before:bg-[#A7FE01] before:rounded-full' :
                            'border-white'">
                    </div>
                    <span class="font-medium text-lg"
                        :class="selected === 3 ? 'text-[#A7FE01]' : 'text-white'">Wanted</span>
                    <input type="radio" name="select" id="" :checked="selected === 3" value="wanted"
                        class="hidden">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-6 w-[80%]">
                <div class="flex flex-col gap-4 w-full">
                    <input name="location" class="w-full p-2" type="text" placeholder="Property Location">
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="number" name="from" placeholder="Price From" class="w-full md:w-1/2 p-2">
                        <input type="number" name="to" placeholder="Price To" class="w-full md:w-1/2 p-2">
                    </div>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <select name="property_type" class="w-full p-2">
                        <option value="">All</option>
                        @foreach ($ptypes as $pt)
                            <option value="{{ $pt->contruct_name }}">{{ $pt->contruct_name }}</option>
                        @endforeach
                    </select>
                    <div class="flex flex-col md:flex-row gap-4">
                        <select class="w-full md:w-1/2 p-2">
                            <option value="">Number of bedrooms</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                            <option value="">7</option>
                            <option value="">8</option>
                        </select>
                        <select class="w-full md:w-1/2 p-2">
                            <option value="">Number of bathrooms</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                            <option value="">7</option>
                            <option value="">8</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <button class="bg-[#59C517] font-bold text-white px-5 py-3 my-4">FIND PROPERTY</button>
            </div>
        </form>
    </section>
    <section>
        <div class="flex justify-center my-6 text-zinc-800">
            <h1
                class="text-3xl lg:text-5xl pb-6 font-semibold relative flex justify-center after:absolute after:bottom-0 after:w-24 after:h-1 after:bg-[#59C517]">
                Latest Properties</h1>
        </div>
        <div class="w-full">
            <a href="#" class="mx-auto block hover:underline text-sm font-semibold w-max text-[#59C517]">View All</a>
            <div class="container mx-auto my-8 flex justify-center flex-wrap ">
                @foreach ($pros as $pr)
                    <div class="p-2 w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                        <div>
                            <img class="w-full h-44 object-cover"
                                src="{{ $pr->photo ? asset('photo/' . $pr->photo) : 'https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png' }}"
                                alt="">
                        </div>
                        <div class="py-2 px-3 border border-gray-300 border-t-0">
                            <div class="space-y-2">
                                <h1>{{ $pr->title }}</h1>
                                <p class="text-sm font-medium text-gray-500 space-x-1">
                                    <i class="fa fa-map-marker-alt"></i>
                                    <span>{{ $pr->location }}</span>
                                </p>
                                <p class="text-sm bg-green-500 text-white font-medium px-2 py-1 rounded-md w-max">Starting
                                    From &#8377; {{ number_format($pr->price) }}/-</p>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">Amenities</p>
                                    <div class="py-2 flex items-center flex-wrap">
                                        @if ($pr->amenities > 0)
                                            @foreach ($pr->amenities as $item)
                                                <div class="text-sm font-semibold text-[#59C517] p-1 space-x-1">
                                                    <i class="fas fa-check"></i>
                                                    <span
                                                        class="text-gray-900">{{ \App\Models\PropertyAmenity::findOrFail($item)->name }}</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No amenities</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-x-4">
                                <a href="{{ route('property.details', $pr->id) }}"
                                    class="bg-gray-500 text-sm px-3 py-1.5 rounded text-white text-center transition duration-300 hover:bg-gray-600">Read
                                    More</a>
                                <a href="#"
                                    class="bg-green-500 text-sm px-3 py-1.5 rounded text-white text-center transition duration-300 hover:bg-green-600">
                                    <i class="fa fa-envelope"></i>
                                    <span>Contact</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-8">
        <div class="flex justify-center my-6 text-zinc-800">
            <h1
                class="text-3xl lg:text-5xl pb-6 font-semibold relative flex justify-center after:absolute after:bottom-0 after:w-24 after:h-1 text-center after:bg-[#59C517]">
                Popular Cities In <span class="text-gray-500 pl-3">India</span></h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 container mx-auto px-8 py-8">
            @for ($i = 0; $i < 8; $i++)
                <div class="bg-[#181D24] transition duration-300 hover:bg-[#59C517] h-32 flex justify-center items-center">
                    <p class="text-2xl font-semibold text-white">Kerala</p>
                </div>
            @endfor
        </div>
    </section>
    <section class="py-8" x-data="{ modal: false }">
        <div x-cloak x-show="modal"
            class="fixed top-0 left-0 w-full h-full bg-black/40 transition duration-300 overflow-hidden z-20 flex justify-center items-center"
            x-transition:enter="ease-in" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-out" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="p-4 bg-white w-2/5 rounded-md">
                <div class="flex justify-between">
                    <h1 class="text-xl font-semibold">Enquire Now</h1>
                    <button type="button" x-on:click="modal = false"><i class="fa fa-times"></i></button>
                </div>
                <form action="#" class="my-4">
                    <div class="flex">
                        <div class="form-group flex flex-col gap-2 w-1/2 p-2">
                            <label for="" class="text-sm font-medium text-gray-500">Name</label>
                            <input type="text" name="" class="border border-gray-400 p-2 text-sm rounded"
                                id="" placeholder="Enter your name">
                        </div>
                        <div class="form-group flex flex-col gap-2 w-1/2 p-2">
                            <label for="" class="text-sm font-medium text-gray-500">Email</label>
                            <input type="email" name="" class="border border-gray-400 p-2 text-sm rounded"
                                id="" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="form-group flex flex-col gap-2 w-1/2 p-2">
                            <label for="" class="text-sm font-medium text-gray-500">Phone No.</label>
                            <input type="text" name="" class="border border-gray-400 p-2 text-sm rounded"
                                id="" placeholder="Enter your phone no">
                        </div>
                        <div class="form-group flex flex-col gap-2 w-1/2 p-2">
                            <label for="" class="text-sm font-medium text-gray-500">Enquire For</label>
                            <select name="" id="" class="border border-gray-400 p-2 text-sm rounded">
                                <option value="">-- Select Enquire For --</option>
                                @foreach ($ptypes as $pt)
                                    <option value="{{ $pt->id }}">{{ $pt->contruct_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-center pt-5">
                        <button type="submit"
                            class="py-2 px-5 rounded bg-[#59C517] text-sm font-medium text-white transition duration-300 hover:shadow-md hover:shadow-[#59C450]">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-center my-6 text-zinc-800">
            <h1
                class="text-3xl lg:text-5xl pb-6 font-semibold relative flex justify-center after:absolute after:bottom-0 after:w-24 after:h-1 after:bg-[#59C517]">
                Featured Properties</h1>
        </div>
        <div class="container mx-auto my-8 flex justify-center flex-wrap p-3">
            @foreach (\App\Models\Property::where('is_featured', 1)->paginate(10) as $pr)
                <div class="p-4 w-1/5">
                    <div class="h-24 overflow-hidden">
                        <img src="{{ $pr->photo ? asset('photo/' . $pr->photo) : 'https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png' }}"
                            alt="">
                    </div>
                    <div class="py-2 px-3 border border-gray-300 border-t-0">
                        <div class="space-y-2">
                            <h1>{{ $pr->title }}</h1>
                            <p class="text-sm font-medium text-gray-500 space-x-1">
                                <i class="fa fa-map-marker-alt"></i>
                                <span>{{ $pr->location }}</span>
                            </p>
                        </div>
                        <button x-on:click="modal = true"
                            class="bg-[#59C517] text-sm font-mediun text-white w-full block text-center py-2 space-x-2 rounded-md mt-4">
                            <i class="fa fa-envelope"></i>
                            <span>Enquire Now</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
