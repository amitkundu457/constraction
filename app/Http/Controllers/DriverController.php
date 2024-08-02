<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();
        return view('driver.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('driver.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver = new Driver();
        $driver['name'] = $request->name;
        $driver['contact'] = $request->contact;
        $driver['email'] = $request->email;
        $driver['address'] = $request->address;
        $driver['city'] = $request->city;
        $driver['state'] = $request->state;
        $driver['pincode'] = $request->pincode;
        $driver->save();

        return redirect()->back()->with('success', __('New driver details added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        dd('probel');
        $driver = Driver::findOrFail($driver->id);
        return view('driver.update', \compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Driver $driver)
    {
        $driver = Driver::findOrFail($id);
        $driver['name'] = $request->name;
        $driver['contact'] = $request->contact;
        $driver['email'] = $request->email;
        $driver['address'] = $request->address;
        $driver['city'] = $request->city;
        $driver['state'] = $request->state;
        $driver['pincode'] = $request->pincode;
        $driver->save();

        return redirect()->back()->with('success', __('Driver details updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Driver $driver)
    {
        Driver::findOrFail($id)->delete();
        return redirect()->back()->with('success', __('Driver details deleted!'));
    }
}
