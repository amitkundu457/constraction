<?php

namespace App\Http\Controllers;

use App\Models\EquipmentManufacturer;
use Illuminate\Http\Request;

class EquipmentManufacturerController extends Controller
{
    public function index(){
        $types = EquipmentManufacturer::all();
        return \view('equipment.manufacturer',\compact('types'));
    }
    public function create(){
        return \view('equipment.manufacturerCreate');
    }
    public function store(Request $request){
        $type = new EquipmentManufacturer();
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','New Equipment Manufacturer added!');
    }
    public function edit($id){
        $type = EquipmentManufacturer::findOrFail($id);
        return \view('equipment.manufacturerUpdate',\compact('type'));
    }
    public function update($id,Request $request){
        $type = EquipmentManufacturer::findOrFail($id);
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','Equipment Manufacturer updated!');
    }
    public function destroy($id){
        EquipmentManufacturer::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Equipment Manufacturer deleted!');
    }
}