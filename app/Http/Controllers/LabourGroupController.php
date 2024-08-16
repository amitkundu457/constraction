<?php

namespace App\Http\Controllers;

use App\Models\LabourGroup;
use Illuminate\Http\Request;

class LabourGroupController extends Controller
{
    public function index(){
        $grps = LabourGroup::all();
        return view('labour.group',compact('grps'));
    }

    public function create(){
        $grps = LabourGroup::all();
        return view('labour.createGroup',\compact('grps'));
    }

    public function store(Request $request){
        $grp = new LabourGroup();
        $grp->name = $request->name;
        $grp->location = $request->location;
        // $grp->parent_group_id = $request->parent_id;
        $grp->save();
        return \redirect()->back()->with('success','New group created!');
    }

    public function edit($id){
        $grp = LabourGroup::findOrFail($id);
        return view('labour.updateGroup',\compact('grp'));
    }

    public function update($id,Request $request){
        $grp = LabourGroup::findOrFail($id);
        $grp->name = $request->name;
        $grp->location = $request->location;
        // $grp->parent_group_id = $request->parent_id;
        $grp->save();
        return \redirect()->back()->with('success','Group updated!');
    }

    public function destroy($id){
        LabourGroup::findOrFail($id)->delete();
        return \redirect()->back()->with('success','Group deleted!');
    }
}
