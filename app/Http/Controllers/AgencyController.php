<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index(){
        $agency = Agency::all();
        return view('agents.agency',compact('agency'));
    }

    public function create(){
        return \view('agents.agencyCreate');
    }

    public function store(Request $request){
        $agency = new Agency();
        $agency->name = $request->name;
        $agency->email = $request->email;
        $agency->phone = $request->phone;
        $agency->address = $request->address;
        $agency->save();
        return \redirect()->back()->with('success','Agency create success!');
    }

    public function show($id){
        $agents = Agent::where('agency_id',$id)->get();
        return \response()->json(['agents'=>$agents]);
    }

    public function edit($id){
        $agency = Agency::findOrFail($id);
        return \view('agents.agencyUpdate',compact('agency'));
    }

    public function update($id,Request $request){
        $agency = Agency::findOrFail($id);
        $agency->name = $request->name;
        $agency->email = $request->email;
        $agency->phone = $request->phone;
        $agency->address = $request->address;
        $agency->save();
        return \redirect()->back()->with('success','Agency update success!');
    }

    public function destroy($id){
        Agency::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Agency delete success!');
    }
}
