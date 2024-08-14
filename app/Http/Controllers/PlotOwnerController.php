<?php

namespace App\Http\Controllers;

use App\Models\PlotOwner;
use Illuminate\Http\Request;

class PlotOwnerController extends Controller
{
    public function index(){
        $owners = PlotOwner::all();
        return \view('plot.plotOwner',\compact('owners'));
    }

    public function create(){
        return view('plot.createOwner');
    }

    public function store(Request $request){
        $documents = [];


        foreach ($request->documents as $item) {
            $fileName = time() . '.' . $item['file']->getClientOriginalName();
            $item['file']->move(public_path('plot'), $fileName);
            $documents[] = ['name' => $item['name'], 'type' => $item['type'], 'file' => $fileName];
        }

        $pown = new PlotOwner();
        $pown->name = $request->name;
        $pown->phone = $request->phone;
        $pown->location = $request->location;
        $pown->state = $request->state;
        $pown->adhaar = $request->adhaar;
        $pown->address = $request->address;
        $pown->documents = $documents;
        $pown->save();

        return \redirect()->back()->with('success','New Owner Added!');
    }

    public function show($id){
        $owner = PlotOwner::findOrFail($id);
        return \response()->json(['owner'=>$owner]);
    }

    public function edit($id){
        $owner = PlotOwner::findOrFail($id);
        return view('plot.updateOwner',\compact('owner'));
    }

    public function update($id,Request $request){
        $pown = PlotOwner::findOrFail($id);
        $documents = [];

        if ($request->documents) {
            $plotDocuments = collect($pown->documents)->pluck('file');
            $requestDocuments = collect($request->documents)->pluck('file_old');

            $unusedDocs = $plotDocuments->diff($requestDocuments);

            $uploadDir = "plot/";
            foreach ($unusedDocs->all() as $docs) {
                if (file_exists(public_path($uploadDir . $docs))) {
                    unlink(public_path($uploadDir . $docs));
                }
            }

            foreach ($request->documents as $item) {
                if (isset($item['file'])) {
                    isset($item['file_old']) && unlink(public_path('plot' . $item['file_old']));
                    $fileName = time() . '.' . $item['file']->getClientOriginalName();
                    $item['file']->move(public_path('plot'), $fileName);
                    $documents[] = ['name' => $item['name'], 'type' => $item['type'], 'file' => $fileName];
                } else {
                    $documents[] = ['name' => $item['name'], 'type' => $item['type'], 'file' => $item['file_old']];
                }
            }
        }

        
        $pown->name = $request->name;
        $pown->phone = $request->phone;
        $pown->location = $request->location;
        $pown->state = $request->state;
        $pown->adhaar = $request->adhaar;
        $pown->address = $request->address;
        $pown->documents = $documents;
        $pown->save();
    }
}
