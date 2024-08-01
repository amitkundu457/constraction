<?php

namespace App\Http\Controllers;

use App\Models\EquipmentCondition;
use Illuminate\Http\Request;

class EquipmentConditionController extends Controller
{
    public function index(){
        $types = EquipmentCondition::all();
        return \view('equipment.condition',\compact('types'));
    }
    public function create(){
        return \view('equipment.conditionCreate');
    }
    public function store(Request $request){
        $type = new EquipmentCondition();
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','New Equipment Condition added!');
    }
    public function edit($id){
        $type = EquipmentCondition::findOrFail($id);
        return \view('equipment.conditionUpdate',\compact('type'));
    }
    public function update($id,Request $request){
        $type = EquipmentCondition::findOrFail($id);
        $type->name = $request->name;
        $type->save();
        return \redirect()->back()->with('success','Equipment Condition updated!');
    }
    public function destroy($id){
        EquipmentCondition::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Equipment Condition deleted!');
    }
}
