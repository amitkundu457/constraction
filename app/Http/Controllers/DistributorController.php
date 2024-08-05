<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        $manufacturers = Distributor::all();
        $categories = FoodCategory::all();
        return \view('food.distributor',\compact('manufacturers','categories'));
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
        $manu = new Distributor();
        $manu->name = $request->name;
        $manu->email = $request->email;
        $manu->food_category_id = $request->food_category_id;
        $manu->phone = $request->phone;
        $manu->city = $request->city;
        $manu->state = $request->state;
        $manu->address = $request->address;
        $manu->save();
        return \redirect()->back()->with('success','New Distributor Added');
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
        $manu = Distributor::findOrFail($id);
        $manu->name = $request->name;
        $manu->email = $request->email;
        $manu->food_category_id = $request->food_category_id;
        $manu->phone = $request->phone;
        $manu->city = $request->city;
        $manu->state = $request->state;
        $manu->address = $request->address;
        $manu->save();
        return \redirect()->back()->with('success','Distributor Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Distributor::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Distributor deleted!');
    }
}
