<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Sheet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpreadsheetController extends Controller
{
    public function index()
    {
       $sheets = Sheet::all();
        $employees = Employee::all();
        $users = User::all();
        return view('spreadsheet.index', compact('sheets','employees','users'));
    }

    public function create()
    {
        return \view('spreadsheet.create');
    }

    public function store(Request $request)
    {

        $sheet = new Sheet();
        $sheet->title = $request->title;
        $sheet->data = $request->data;
        $sheet->save();

        return \redirect()->route('sheet.index')->with('success','New sheet created');
    }

    public function edit($id)
    {
        $sheet = Sheet::findOrFail($id);
        return \view('spreadsheet.update',compact('sheet'));
    }

    public function update(Request $request,$id){
        $sheet = Sheet::findOrFail($id);
        $sheet->title = $request->title;
        $sheet->data = $request->data;
        $sheet->save();

        return \redirect()->route('sheet.index')->with('success','Sheet updated');
    }

   
}
