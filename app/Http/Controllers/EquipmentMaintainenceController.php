<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Equipment;
use App\Models\EquipmentCondition;
use Illuminate\Http\Request;
use App\Models\QualityControl;
use App\Models\EquipmentMaintainence;

class EquipmentMaintainenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eqpms = EquipmentMaintainence::all();
        $eqps = Equipment::with('quality')->get();
        $agents = Agent::all();
        return \view('equipment.maintainance',\compact('eqpms','eqps','agents'));
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
        $eqpm = new EquipmentMaintainence();
        $eqpm->equipment_id = $request->equipment_id;
        $eqpm->service_type = $request->service_type;
        $eqpm->quality_control_id = $request->quality_control_id;
        $eqpm->agent_id = $request->agent_id;
        $eqpm->service_frequency_type = $request->service_frequency_type;
        $eqpm->service_frequency_time = $request->service_frequency_time;
        $eqpm->description = $request->description;
        $eqpm->save();
        return \redirect()->back()->with('success','Equipment Service Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentMaintainence  $equipmentMaintainence
     * @return \Illuminate\Http\Response
     */
    public function show($id,EquipmentMaintainence $equipmentMaintainence)
    {
        $eqpm = EquipmentMaintainence::findOrFail($id);
        $conditions = EquipmentCondition::all();
        return view('equipment.maintainanceShow',compact('eqpm','conditions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentMaintainence  $equipmentMaintainence
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentMaintainence $equipmentMaintainence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentMaintainence  $equipmentMaintainence
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, EquipmentMaintainence $equipmentMaintainence)
    {
        $eqpm = EquipmentMaintainence::findOrFail($id);
        $eqpm->equipment_id = $request->equipment_id;
        $eqpm->service_type = $request->service_type;
        $eqpm->quality_control_id = $request->quality_control_id;
        $eqpm->agent_id = $request->agent_id;
        $eqpm->service_frequency_type = $request->service_frequency_type;
        $eqpm->service_frequency_time = $request->service_frequency_time;
        $eqpm->description = $request->description;
        $eqpm->save();
        return \redirect()->back()->with('success','Equipment Service Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentMaintainence  $equipmentMaintainence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,EquipmentMaintainence $equipmentMaintainence)
    {
        EquipmentMaintainence::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Equipment Service Deleted!');
    }

    public function getQualityByEquipment($id){
        $quality = QualityControl::where('equipment_id',$id)->get();
        return \response()->json(['quality'=>$quality]);
    }

    public function reviewReport($id,Request $request){
        $eqpm = EquipmentMaintainence::findOrFail($id);
        $eqpm->equipment_condition_id = $request->equipment_condition_id;
        $eqpm->review_date = $request->review_date;
        $eqpm->report = $request->report;
        $eqpm->save();
        return \redirect()->back()->with('success','Equipment Service Updated!');
    }
}
