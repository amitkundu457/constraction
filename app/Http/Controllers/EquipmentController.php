<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentManufacturer;
use App\Models\EquipmentType;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::all();
        $types = EquipmentType::all();
        $manufacs = EquipmentManufacturer::all();
         return view('equipment.index',compact('equipments','types','manufacs'));
    }

    public function store(Request $request)
    {
        $equipment = new Equipment();
        $equipment->name = $request->name;
        $equipment->equipment_type_id = $request->equipment_type_id;
        $equipment->quantity = $request->quantity;
        $equipment->equipment_manufacturer_id = $request->equipment_manufacturer_id;
        $equipment->model_number = $request->model_number;
        $equipment->purchase_date = $request->purchase_date;
        $equipment->purchase_price = $request->purchase_price;
        $equipment->description = $request->description;
        $equipment->status = $request->status;
        $equipment->save();
        return \redirect()->back()->with('success','Equipment added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    
    public function update($id,Request $request, Equipment $equipment)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->name = $request->name;
        $equipment->equipment_type_id = $request->equipment_type_id;
        $equipment->quantity = $request->quantity;
        $equipment->equipment_manufacturer_id = $request->equipment_manufacturer_id;
        $equipment->model_number = $request->model_number;
        $equipment->purchase_date = $request->purchase_date;
        $equipment->purchase_price = $request->purchase_price;
        $equipment->description = $request->description;
        $equipment->status = $request->status;
        $equipment->save();
        return \redirect()->back()->with('success','Equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipment::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Equipment deleted successfully!');
    }
}
