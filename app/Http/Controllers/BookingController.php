<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        $users = User::all();
        $vtypes = VehicleType::all();
        $drivers = Driver::all();
        return view('fleet.booking', \compact('bookings', 'users', 'vtypes', 'drivers'));
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
        $booking = new Booking();
        $booking->user_id = $request->user_id;
        $booking->vehicle_type_id = $request->vehicle_type_id;
        $booking->vehicle_id = $request->vehicle_id;
        $booking->driver_id = $request->driver_id;
        $booking->type = $request->type;
        $booking->start_location = $request->start_location;
        $booking->end_location = $request->end_location;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->amount = $request->amount;
        $booking->status = $request->status;
        $booking->save();
        return \redirect()->back()->with('success', 'New booking added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Booking $booking)
    {
        $booking = Booking::findOrFail($id);
        $booking->user_id = $request->user_id;
        $booking->vehicle_type_id = $request->vehicle_type_id;
        $booking->vehicle_id = $request->vehicle_id;
        $booking->driver_id = $request->driver_id;
        $booking->type = $request->type;
        $booking->start_location = $request->start_location;
        $booking->end_location = $request->end_location;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->amount = $request->amount;
        $booking->status = $request->status;
        $booking->save();
        return \redirect()->back()->with('success', 'Booking updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Booking $booking)
    {
        Booking::findOrFail($id)->delete();
        return \redirect()->back()->with('success', 'Booking deleted!');
    }

    public function getVehicleFromType($id)
    {
        $vehicles = Vehicle::where('vehicle_type_id', $id)->get();
        return \response()->json(['vehicles' => $vehicles]);
    }
}
