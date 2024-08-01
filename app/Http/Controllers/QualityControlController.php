<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\QualityControl;
use Illuminate\Http\Request;

class QualityControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quals = QualityControl::all();
        $eqps = Equipment::all();
        return view('equipment.qualitycontrol',compact('quals','eqps'));
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
        $qual = new QualityControl();
        $qual->equipment_id = $request->equipment_id;
        $qual->verification_method = $request->verification_method;
        $qual->acceptance_criteria = $request->acceptance_criteria;
        $qual->save();
        return \redirect()->back()->with('success','Quality control added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function show($id,QualityControl $qualityControl)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function edit(QualityControl $qualityControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, QualityControl $qualityControl)
    {
        $qual = QualityControl::findOrFail($id);
        $qual->equipment_id = $request->equipment_id;
        $qual->verification_method = $request->verification_method;
        $qual->acceptance_criteria = $request->acceptance_criteria;
        $qual->save();
        return \redirect()->back()->with('success','Quality control updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualityControl  $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,QualityControl $qualityControl)
    {
        QualityControl::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Quality control deleted!');
    }

}
