<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\PlotOwner;
use App\Models\Project;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function index()
    {
        $plots = Plot::all();
        return view('plot.index', \compact('plots'));
    }

    public function create()
    {
        $owners = PlotOwner::all();
        $projects = Project::all();
        return view('plot.create',\compact('owners','projects'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //     'name' => 'required',
        //     'project_name' => 'required',
        //     'block_name' => 'required',
        //     'khasra_no' => 'required',
        //     'phone_no' => 'required',
        //     'mauza_no' => 'required',
        //     'address' => 'required',
        //     'documents' => 'required',
        //     'amount' => 'required',
        //     'total_plots' => 'required',
        //     'plots.0.name' => 'required',
        //     'status' => 'required'
        // ]);

        $documents = [];

        foreach ($request->documents as $item) {
            $fileName = time() . '.' . $item['file']->getClientOriginalName();
            $item['file']->move(public_path('plot'), $fileName);
            $documents[] = ['name' => $item['name'], 'type' => $item['type'], 'file' => $fileName];
        }
        Plot::create([
            'owner_id' => $request->owner_id,
            'project_id' => $request->project_id,
            'block_name' => $request->block_name,
            'khasra_no' => $request->khasra_no,
            'phone_no' => $request->phone_no,
            'mauza_no' => $request->mauza_no,
            'address' => $request->address,
            'documents' => $documents,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'total_plots' => $request->total_plots,
            'plot_list' => $request->plots
        ]);
        return \redirect()->route('plot.index')->with('success', $request->name . ' plot created successfully');
    }



    public function edit($id)
    {
        $plot = Plot::findOrFail($id);
        $owners = PlotOwner::all();
        $projects = Project::all();
        return view('plot.update', \compact('plot','owners','projects'));
    }

    public function update($id, Request $request)
    {


        // $request->validate([
        //     'name' => 'required',
        //     'project_name' => 'required',
        //     'block_name' => 'required',
        //     'khasra_no' => 'required',
        //     'phone_no' => 'required',
        //     'mauza_no' => 'required',
        //     'address' => 'required',
        //     'documents' => 'required',
        //     'amount' => 'required',
        //     'total_plots' => 'required',
        //     'plots.0.name' => 'required',
        //     'status' => 'required'
        // ]);

        $plot = Plot::findOrFail($id);
        $documents = [];

        if ($request->documents) {
            $plotDocuments = collect($plot->documents)->pluck('file');
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

        $plot->update([
            'owner_id' => $request->owner_id,
            'project_id' => $request->project_id,
            'block_name' => $request->block_name,
            'khasra_no' => $request->khasra_no,
            'phone_no' => $request->phone_no,
            'mauza_no' => $request->mauza_no,
            'address' => $request->address,
            'documents' => $documents,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'total_plots' => $request->total_plots,
            'plot_list' => $request->plots
        ]);
        return \redirect()->route('plot.index')->with('success', $request->name . ' plot updated successfully');
    }

    public function destroy($id){
        $plot = Plot::findOrFail($id);

        foreach($plot->documents as $docs){
            if(\file_exists(\public_path('plot/'.$docs['file']))){
                \unlink(\public_path('plot/'.$docs['file']));
            }
        }

        $plot->delete();

        return \redirect()->route('plot.index')->with('success', ' Plot deleted successfully');
    }
}
