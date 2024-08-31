<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use App\Models\Vender;
use App\Models\Project;
use App\Models\LabourWork;
use App\Models\LabourGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabourSiteController extends Controller
{
    public function labourWithSite()
    {
        $projects = Project::all();
        $lb = Labour::all();
        $grps = LabourGroup::all();
        $sites = Vender::all();
        $labourst = LabourWork::all();
        return view('labour/labourwisthsite', compact('labourst','lb', 'grps', 'sites', 'projects'));
    }

    public function LabourWithsitecreate()
    {
        
        $lb = Labour::all();
        $grps = LabourGroup::all();
        $sites = Vender::all();
        return view('labour/labourwithsitecreate', compact('grps', 'sites', 'lb'));
    }
    public function labourStorewithsite(Request $request){
        $lbsite= new LabourWork();
        $lbsite->labour_group_id=$request->labour_group_id;
        $lbsite->labour_id=$request->labour_id;
        $lbsite->project_id=$request->project_id;
        $lbsite->site_id=$request->site_id;
        $lbsite->save();

        return \redirect()->back()->with('success','Site wise labour added');
    }

    public function projects(){
        $projects = Project::all();
        return \response()->json(['projects'=>$projects]);
    }

    public function labours($id){
        $labours = LabourGroup::findOrFail($id)->labours;
        return \response()->json(['labours'=>$labours]);
    }
}
