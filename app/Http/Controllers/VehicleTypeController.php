<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index(){
        $types = VehicleType::all();
        return \view('fleet.vehicleType',\compact('types'));
    }
    public function create(){
        return \view('fleet.vehicleTypeCreate');
    }
    public function store(Request $request){
        $type = new VehicleType();
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','New vehicle type added!');
    }
    public function edit($id){
        $type = VehicleType::findOrFail($id);
        return \view('fleet.vehicleTypeUpdate',\compact('type'));
    }
    public function update($id,Request $request){
        $type = VehicleType::findOrFail($id);
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','Vehicle type updated!');
    }
    public function destroy($id){
        VehicleType::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Vehicle type deleted!');
    }
}
