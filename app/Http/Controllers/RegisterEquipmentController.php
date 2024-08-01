<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\RegisterEquipment;
use App\Models\Vender;
use App\Models\warehouse;

class RegisterEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regeqps = RegisterEquipment::all();
        $eqps = Equipment::all();
        $locations = Vender::all();
        $sites = warehouse::all();
        $projects = Project::all();
         return view('equipment.registerEquipment',compact('projects','eqps','regeqps','locations','sites'));
    }

    public function store(Request $request)
    {
        $regeqp = new RegisterEquipment();
        $regeqp->equipment_id = $request->equipment_id;
        $regeqp->project_id = $request->project_id;
        $regeqp->vender_id = $request->vender_id;
        $regeqp->warehouse_id = $request->warehouse_id;
        $regeqp->quantity = $request->quantity;
        $regeqp->date = $request->date;
        $regeqp->description = $request->description;
        $regeqp->save();
        return \redirect()->back()->with('success','Equipment registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisterEquipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterEquipment $equipment)
    {
        //
    }

    
    public function update($id,Request $request, RegisterEquipment $equipment)
    {
        $regeqp = RegisterEquipment::findOrFail($id);
        $regeqp->equipment_id = $request->equipment_id;
        $regeqp->project_id = $request->project_id;
        $regeqp->vender_id = $request->vender_id;
        $regeqp->warehouse_id = $request->warehouse_id;
        $regeqp->quantity = $request->quantity;
        $regeqp->date = $request->date;
        $regeqp->description = $request->description;
        $regeqp->save();
        return \redirect()->back()->with('success','Registered equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisterEquipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RegisterEquipment::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Equipment unregistered!');
    }
}
