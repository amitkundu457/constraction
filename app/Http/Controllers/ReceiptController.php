<?php

namespace App\Http\Controllers;

use App\Models\Vender;
use App\Models\Company;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\ProductService;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
  public function index(){
    $rcs = Receipt::all();
    return view('receipt.index',\compact('rcs'));
  }

  public function create(){
    $projs = Project::all();
    $venders = Vender::all();
    $company = Company::all();
    $prchs = Purchase::all();
    $mats = ProductService::all();
    return view('receipt.create',compact('projs','venders','company','prchs','mats'));
  }

  public function store(Request $request){
    $rc = new Receipt();
    $rc->number = $request->number;
    $rc->project_id = $request->project_id;
    $rc->company_id = $request->company_id;
    $rc->vender_id = $request->vender_id;
    $rc->date = $request->date;
    $rc->materials = $request->items;
    $rc->save();
    return \redirect()->route('receipt.index')->with('success','New receipt added.');
  }
  
  public function edit($id){
    $projs = Project::all();
    $venders = Vender::all();
    $company = Company::all();
    $prchs = Purchase::all();
    $mats = ProductService::all();
    $rc = Receipt::findOrFail($id);
    return view('receipt.update',compact('rc','projs','venders','company','prchs','mats'));
  }

  public function update(Request $request,$id){
    $rc = Receipt::findOrFail($id);
    $rc->number = $request->number;
    $rc->project_id = $request->project_id;
    $rc->company_id = $request->company_id;
    $rc->vender_id = $request->vender_id;
    $rc->date = $request->date;
    $rc->materials = $request->materials;
    $rc->save();
    return \redirect()->route('receipt.index')->with('success','receipt updated.');
  }

  public function destroy($id){
    Receipt::findOrFail($id)->delete();
    return \redirect()->route('receipt.index')->with('success','receipt deleted.');
  }
}
