<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sell(Request $request)
    {
        $location = $request->input('location');
        $ptype = $request->input('property_type');
        $from = $request->input('from') ?? 0;
        $to = $request->input('to');
        $area = $request->input('area');


        $sells = \App\Models\Property::query()
            ->where('property_type', \App\Models\PropertyType::where('type_name', 'Sale')->first()->id)
            ->when($to, function ($query, $to) use ($from) {
                $query->whereBetween('price', [intval($from), intval($to)]);
            })
            ->when($from, function ($query, $from) {
                $query;
            })
            ->where('location', 'like', '%' . $location . '%')
            ->when($area, function ($query, $area) {
                $query->where('area', 'like', '%' . $area . '%')->orWhereNull('area');
            })
            ->whereHas('contruct', function ($q) use ($ptype) {
                $q->where('contruct_name', 'like', '%' . $ptype . '%');
            })
            ->paginate(10);



        return view('frontend.sell', compact('sells'));
    }

    public function rent(Request $request)
    {
        $location = $request->input('location');
        $ptype = $request->input('property_type');
        $from = $request->input('from') ?? 0;
        $to = $request->input('to');
        $area = $request->input('area');


        $rents = \App\Models\Property::query()
            ->where('property_type', \App\Models\PropertyType::where('type_name', 'Rent')->first()->id)
            ->when($from, function ($query, $from) {
                $query->where('price', '>=', intval($from));
            })
            ->when($to, function ($query, $to) use ($from) {
                $query->whereBetween('price', [intval($from), intval($to)]);
            })
            ->where('location', 'like', '%' . $location . '%')
            ->when($area, function ($query, $area) {
                $query->where('area', 'like', '%' . $area . '%')
                    ->orWhereNull('area');
            })
            ->whereHas('contruct', function ($q) use ($ptype) {
                $q->where('contruct_name', 'like', '%' . $ptype . '%');
            })
            ->paginate(10);
        return view('frontend.rent', compact('rents'));
    }

    public function wanted(Request $request)
    {
        $location = $request->input('location');
        $ptype = $request->input('property_type');
        $from = $request->input('from') ?? 0;
        $to = $request->input('to');
        $area = $request->input('area');


        $wanteds = \App\Models\Property::query()
            ->where('property_type', \App\Models\PropertyType::where('type_name', 'Wanted')->first()->id)
            ->when($from, function ($query, $from) {
                $query->where('price', '>=', intval($from));
            })
            ->when($to, function ($query, $to) use ($from) {
                $query->whereBetween('price', [intval($from), intval($to)]);
            })
            ->where('location', 'like', '%' . $location . '%')
            ->when($area, function ($query, $area) {
                $query->where('area', 'like', '%' . $area . '%')
                    ->orWhereNull('area');
            })
            ->whereHas('contruct', function ($q) use ($ptype) {
                $q->where('contruct_name', 'like', '%' . $ptype . '%');
            })
            ->paginate(10);
        return view('frontend.wanted', compact('wanteds'));
    }
    public function commercial(Request $request)
    {
        $location = $request->input('location');
        $ptype = $request->input('property_type');
        $from = $request->input('from') ?? 0;
        $to = $request->input('to');
        $area = $request->input('area');


        $wanteds = \App\Models\Property::query()->where('contract_type', \App\Models\Contruct::where('type', 'commercials')->first()->id)
            ->where('location', 'like', '%' . $location . '%')
            ->when($area, function ($query, $area) {
                $query->where('area', 'like', '%' . $area . '%')
                    ->orWhereNull('area');
            })

            ->whereHas('contruct', function ($q) use ($ptype) {
                $q->where('contruct_name', 'like', '%' . $ptype . '%');
            })

            ->when($to, function ($query, $to) use ($from) {
                $query->whereBetween('price', [intval($from), intval($to)])
                    ->orWhere('price', '>=', intval($from));
            })
            ->paginate(10);
        return view('frontend.wanted', compact('wanteds'));
    }

    public function agent(Request $request)
    {
        $agents = Agent::paginate(10);
        return view('frontend.agents', compact('agents'));
    }
}
