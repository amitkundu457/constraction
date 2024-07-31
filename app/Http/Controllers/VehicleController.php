<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        $vehicleTypes = VehicleType::all();
        return view('fleet.index',\compact('vehicles','vehicleTypes'));
    }

    public function store(Request $request){
        $vehicle = new Vehicle();
        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->code = $request->code;
        $vehicle->number = $request->number;
        $vehicle->purchase_date = $request->purchase_date;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->kmpl = $request->kmpl;
        $vehicle->purchase_amount = $request->purchase_amount;
        $vehicle->start_meter_reading = $request->start_meter_reading;
        $vehicle->status = $request->status;
        $vehicle->notes = $request->notes;
        $vehicle->save();
        return \redirect()->route('vehicle.index')->with('success','Vehicle added successfully!');
    }

    public function update($id,Request $request){
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->vehicle_type_id = $request->vehicle_type_id;
        $vehicle->code = $request->code;
        $vehicle->number = $request->number;
        $vehicle->purchase_date = $request->purchase_date;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->kmpl = $request->kmpl;
        $vehicle->purchase_amount = $request->purchase_amount;
        $vehicle->start_meter_reading = $request->start_meter_reading;
        $vehicle->status = $request->status;
        $vehicle->notes = $request->notes;
        $vehicle->save();
        return \redirect()->route('vehicle.index')->with('success','Vehicle updated successfully!');
    }

    public function destroy($id){
        Vehicle::findOrFail($id)->delete();
        return \redirect()->route('vehicle.index')->with('success','Vehicle deleted successfully!');
    }
}
