<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Models\LabourGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LabourController extends Controller
{
    public function index(){
        $labours = Labour::all();
        return \view('labour.index',\compact('labours'));
    }

    public function create(){
        $grps = LabourGroup::all();
        return \view('labour.create',\compact('grps'));
    }
    public function store(Request $request){
        $lb = new Labour();
        $lb->name = $request->name;
        $lb->labour_group_id = $request->labour_group_id;
        $lb->name = $request->name;
        $lb->phone = $request->phone;
        $lb->adhaar = $request->adhaar;
        $lb->price = $request->price;
        $lb->documents = $request->file('documents')->store('uploads/labour','public');
        $lb->save();
        return \redirect()->back()->with('success','New labour added!');
    }
    public function edit($id){
        $lb = Labour::findOrFail($id);
        $grps = LabourGroup::all();
        return \view('labour.update',\compact('lb','grps'));
    }
    public function update($id,Request $request){
        $lb = Labour::findOrFail($id);
        $lb->name = $request->name;
        $lb->labour_group_id = $request->labour_group_id;
        $lb->name = $request->name;
        $lb->phone = $request->phone;
        $lb->adhaar = $request->adhaar;
        $lb->price = $request->price;
        // $lb->documents = $request->file('documents')->store('uploads/labour','public');
        $lb->save();
        return \redirect()->back()->with('success','Labour updated!');
    }

    public function destroy($id){
        $lb = Labour::findOrFail($id);
        if(Storage::disk('public')->exists($lb->documents)){
            Storage::disk('public')->delete($lb->documents);
        }
        $lb->delete();
        return \redirect()->back()->with('success','Labour deleted!');
    }
}
