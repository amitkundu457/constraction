<?php

namespace App\Http\Controllers;

use App\Models\SheetShare;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SheetShareController extends Controller
{
    public function store(Request $request,$id){
        $share = new SheetShare();
        $share->sheet_id = $id;
        if($request->type == 1){
            $share->employee_id = $request->employee_id;
        }elseif($request->type == 2){
            $share->user_id = $request->user_id;
        }
        $share->token = Str::random(10);
        $share->is_editable = $request->is_editable ?? 0; 
        $share->is_viewable = $request->is_viewable ?? 0;
        $share->save(); 

        return \redirect()->route('sheet.index')->with('success','File share successfully');
    }

    public function show($id){
        $share = SheetShare::where('sheet_id',$id)->first();
        return \view('spreadsheet.share',compact('share'));
    }

    public function destroy($id){
        SheetShare::where('sheet_id',$id)->delete();
        return \redirect()->route('sheet.index')->with('success','File share stopped');
    }
}
