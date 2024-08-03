<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Fuel;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuels = Fuel::all();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        return \view('fleet.fuel',\compact('fuels','vehicles','drivers'));
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
        $fuel = new Fuel();
        $fuel->vehicle_id = $request->vehicle_id;
        $fuel->driver_id = $request->driver_id;
        $fuel->fill_date = $request->fill_date;
        $fuel->quantity = $request->quantity;
        $fuel->odometer = $request->odometer;
        $fuel->amount = $request->amount;
        $fuel->notes = $request->notes;
        $fuel->save();

        return \redirect()->back()->with('success','Fuel added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel $fuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel $fuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Fuel $fuel)
    {
        $fuel = Fuel::findOrFail($id);
        $fuel->vehicle_id = $request->vehicle_id;
        $fuel->driver_id = $request->driver_id;
        $fuel->fill_date = $request->fill_date;
        $fuel->quantity = $request->quantity;
        $fuel->odometer = $request->odometer;
        $fuel->amount = $request->amount;
        $fuel->notes = $request->notes;
        $fuel->save();
        return \redirect()->back()->with('success','Fuel updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Fuel $fuel)
    {
        Fuel::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Fuel updated successfully');
    }

    // public function getDriverByBooking($id){
    //     $bookings = Booking::where('vehicle_id',$id)->get();
    //     return response()->json(['bookings'=>$bookings]);
    // }
}
