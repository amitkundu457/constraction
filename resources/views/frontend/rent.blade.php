@extends('layouts.frontend')
@section('content')
    <section class="w-full h-full py-8 relative px-14 flex">
        <aside class="w-1/5 h-full">
            <div class="bg-[#59C517] text-center py-2 font-semibold text-white">
                <h1 class="">Refine Your search</h1>
            </div>
            <form action="{{ url('/rent') }}" class="h-full border border-gray-400 border-t-0 space-y-2 py-2">
                <div class="px-3 space-y-2">
                    <label for="" class="text-sm font-semibold">Location</label>
                    <input type="text" name="location" value="{{ request()->query('location') }}" placeholder="Type location"
                        class="p-2 border border-gray-300 rounded text-sm w-full">
                </div>
                <div class="px-3 space-y-2">
                    <label for="" class="text-sm font-semibold">Property Type</label>
                    <select name="property_type" id="" class="p-2 border border-gray-300 rounded text-sm w-full">
                        <option value="">All</option>
                        @foreach (\App\Models\Contruct::all() as $item)
                            <option value="{{ $item->contruct_name }}" @selected(request()->query('property_type') == $item->contruct_name)>{{ $item->contruct_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="px-3 space-y-2">
                    <label for="" class="text-sm font-semibold">Price From</label>
                    <input type="number" name="from" placeholder=""
                        class="p-2 border border-gray-300 rounded text-sm w-full" value="{{ request()->query('from') }}">
                </div>
                <div class="px-3 space-y-2">
                    <label for="" class="text-sm font-semibold">Price To</label>
                    <input type="number" name="to" placeholder=""
                        class="p-2 border border-gray-300 rounded text-sm w-full" value="{{ request()->query('to') }}">
                </div>
                <div class="px-3 space-y-2">
                    <label for="" class="text-sm font-semibold">Land Area</label>
                    <input type="text" name="area" placeholder="e.g. 15 Sqft"
                        class="p-2 border border-gray-300 rounded text-sm w-full" value="{{ request()->query('area') }}">
                </div>
                <div class="flex justify-center py-2">
                    <button class="bg-[#59C517] px-4 py-2 space-x-1 text-sm font-semibold text-white rounded"><i
                            class="fas fa-search"></i><span>Refine Search</span></button>
                </div>
            </form>
        </aside>
        <div class="w-4/5 px-4">
            <div class="border border-gray-300 border-t-0 p-2 text-sm font-semibold text-gray-500">
                <h1 class="px-3">Properties Rent ({{ $rents->count() }})</h1>
            </div>
            <div class="border border-gray-300 border-y-0">
                <div>
                    @if ($rents->count() > 0)
                    @foreach ($rents as $r)
                        <div class="px-5 border-b border-gray-300 border-t-0 py-3">
                            <a href="{{ route('property.details',$r->id) }}" class="text-[#59C517] font-bold hover:underline">{{ $r->title }}</a>
                            <div class="flex">
                                <div class="py-3">
                                    <img width="200"
                                        src="{{$r->photo ? asset('photo/'.$r->photo) : 'https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png'}}"
                                        alt="">
                                </div>
                                <div class="px-3 py-3">
                                    <p class="font-semibold bg-gray-400 px-4 py-1 rounded text-white w-max">Starting From
                                        &#8377; {{ number_format($r->price) }}/-</p>
                                        <p class="text-sm flex items-center text-gray-500 gap-x-1 mt-2">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $r->location }}</span>
                                        </p>
                                    <div class="py-2 flex items-center flex-wrap">
                                        @foreach ($r->amenities as $a)
                                            <div class="text-sm font-semibold text-[#59C517] p-1 space-x-1">
                                                <i class="fas fa-check"></i>
                                                <span class="text-gray-900">{{ \App\Models\PropertyAmenity::findOrFail($a)->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('property.details', $r->id) }}"
                                            class="text-sm font-medium border border-gray-400 p-1.5 px-3 w-max block rounded transition duration-300 hover:text-[#59C517]">
                                            <i class="fas fa-external-link-alt"></i>
                                            <span class="pl-1">View Details</span>
                                        </a>
                                        <a href="#"
                                            class="text-sm font-medium border border-gray-400 p-1.5 px-3 w-max block rounded transition duration-300 hover:text-[#59C517]">
                                            <i class="fas fa-user-tie"></i>
                                            <span class="pl-1">Contact Agent</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="ml-auto space-y-2">
                                    <p class="text-sm font-semibold text-zinc-400">Posted By</p>
                                    <img width="80"
                                        src="https://equi.org.in/demo/propertyportal/btPublic/html/images/not_available.jpg"
                                        alt="">
                                    <p class="text-sm font-semibold text-[#59C517]">13 Jun, 2024</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <div class="py-8">
                            <p class="text-sm font-semibold text-gray-400 text-center">No Data To Show</p>
                        </div>
                    @endif
                </div>
                @if ($rents->lastPage() != 1)
                <div class="flex justify-center items-center py-4 border border-b border-gray-300 gap-2 [&>a]:block [&>a]:font-semibold [&>a]:text-white [&>a]:px-2 [&>a]:py-0.5  [&>a]:rounded-full [&>a]:bg-[#59C517]">
                    <a href="#"><i class="fas fa-chevron-left"></i></a>
                    <a href="#"><span>1</span></a>
                    <a href="#"><span>2</span></a>
                    <a href="#"><span>3</span></a>
                    <a href="#"><i class="fas fa-chevron-right"></i></a>
                </div>
                @endif
            </div>
        </div>
        {{-- <aside class="w-1/5">

    </aside> --}}
    </section>
@endsection
