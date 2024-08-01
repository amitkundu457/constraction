<?php

namespace App\Http\Controllers;

use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    public function index(){
        $types = EquipmentType::all();
        return \view('equipment.type',\compact('types'));
    }
    public function create(){
        return \view('equipment.typeCreate');
    }
    public function store(Request $request){
        $type = new EquipmentType();
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','New Equipment Type added!');
    }
    public function edit($id){
        $type = EquipmentType::findOrFail($id);
        return \view('equipment.typeUpdate',\compact('type'));
    }
    public function update($id,Request $request){
        $type = EquipmentType::findOrFail($id);
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','Equipment type updated!');
    }
    public function destroy($id){
        EquipmentType::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Equipment type deleted!');
    }
}
