<?php

namespace App\Http\Controllers;

use App\Models\FoodArea;
use Illuminate\Http\Request;

class FoodAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = FoodArea::all();
        return \view('food.area',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.areaCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new FoodArea();
        $area->name = $request->name;
        $area->save();
        return \redirect()->back()->with('success','New area added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FoodArea  $foodArea
     * @return \Illuminate\Http\Response
     */
    public function show(FoodArea $foodArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoodArea  $foodArea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = FoodArea::findOrFail($id);
        return \view('food.areaUpdate',\compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodArea  $foodArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $area = FoodArea::findOrFail($id);
        $area->name = $request->name;
        $area->save();
        return \redirect()->back()->with('success','Area updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodArea  $foodArea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FoodArea::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Area deleted!');
    }
}
