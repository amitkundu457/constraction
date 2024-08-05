<?php

namespace App\Http\Controllers;

use App\Models\FoodArea;
use App\Models\Retailer;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    public function index()
    {
        $retailers = Retailer::all();
        $categories = FoodCategory::all();
        $areas = FoodArea::all();
        return \view('food.retailer',\compact('retailers','categories','areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manu = new Retailer();
        $manu->name = $request->name;
        $manu->email = $request->email;
        $manu->food_category_id = $request->food_category_id;
        $manu->food_area_id = $request->food_area_id;
        $manu->phone = $request->phone;
        $manu->city = $request->city;
        $manu->state = $request->state;
        $manu->address = $request->address;
        $manu->save();
        return \redirect()->back()->with('success','New Retailer Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $manu = Retailer::findOrFail($id);
        $manu->name = $request->name;
        $manu->email = $request->email;
        $manu->food_category_id = $request->food_category_id;
        $manu->food_area_id = $request->food_area_id;
        $manu->phone = $request->phone;
        $manu->city = $request->city;
        $manu->state = $request->state;
        $manu->address = $request->address;
        $manu->save();
        return \redirect()->back()->with('success','Retailer Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Retailer::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Retailer deleted!');
    }
}
