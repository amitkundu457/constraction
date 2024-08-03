<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleExpenses;
use Illuminate\Http\Request;

class VehicleExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = VehicleExpenses::all();
        $vehicles = Vehicle::all();
        return view('fleet.expenses', \compact('expenses', 'vehicles'));
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
        $expense = new VehicleExpenses();
        $expense->vehicle_id = $request->vehicle_id;
        $expense->type = $request->type;
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->save();
        return \redirect()->back()->with('success', 'New record added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleExpenses  $vehicleExpenses
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleExpenses $vehicleExpenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleExpenses  $vehicleExpenses
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleExpenses $vehicleExpenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleExpenses  $vehicleExpenses
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, VehicleExpenses $vehicleExpenses)
    {
        $expense = VehicleExpenses::findOrFail($id);
        $expense->vehicle_id = $request->vehicle_id;
        $expense->type = $request->type;
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->save();
        return \redirect()->back()->with('success', 'Record updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleExpenses  $vehicleExpenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,VehicleExpenses $vehicleExpenses)
    {
        VehicleExpenses::findOrFail($id)->delete();
        return \redirect()->back()->with('success', 'Record deleted!');
        
    }
}
