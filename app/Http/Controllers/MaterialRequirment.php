<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MaterialRequirment as ModelsMaterialRequirment;
use Illuminate\Http\Request;


class MaterialRequirment extends Controller
{
    public function index()
    {
        $mq = ModelsMaterialRequirment::join('projects', 'projects.id', '=', 'material_requirments.project_id')
            ->join('employees', 'employees.id', '=', 'material_requirments.employee_id')
            ->join('product_services', 'product_services.id', '=', 'material_requirments.material_id')
            ->select(
                // 'material_requirments.*',
                'projects.project_name',
                'product_services.name as pro_name',
                'employees.name',
                'material_requirments.id',
                'material_requirments.qty',
                'material_requirments.purpose'
            )->get();
        // dd($mq);

        return view('materialrequest.mq', compact('mq'));
    }

    public function store(Request $request)
    {
        $data = new ModelsMaterialRequirment();
        $data->material_id = $request->material_id;
        $data->project_id = $request->project_id;
        $data->employee_id = $request->employee_id;
        $data->purpose = $request->purpose;
        $data->qty = $request->qty;
        $data->status = 0;
        $data->save();
        return back();
    }

    public function MqSuperadmin()
    {
        $mq = ModelsMaterialRequirment::join('projects', 'projects.id', '=', 'material_requirments.project_id')
            ->join('employees', 'employees.id', '=', 'material_requirments.employee_id')
            ->join('product_services', 'product_services.id', '=', 'material_requirments.material_id')
            ->select(
                // 'material_requirments.*',
                'projects.project_name',
                'product_services.name as pro_name',
                'employees.name',
                'material_requirments.id',
                'material_requirments.qty',
                'material_requirments.purpose'
            )->get();
        return view('materialrequest.mqadmin', compact('mq'));
    }

    public function searchBar(Request $request)
    {
        $startDate = $request->input('start_date'); // Assuming the start date is passed via a form or query parameter
        $endDate = $request->input('end_date');

        $mq = ModelsMaterialRequirment::join('projects', 'projects.id', '=', 'material_requirments.project_id')
            ->join('employees', 'employees.id', '=', 'material_requirments.employee_id')
            ->join('product_services', 'product_services.id', '=', 'material_requirments.material_id')
            ->select(
                'projects.project_name',
                'product_services.name as pro_name',
                'employees.name',
                'material_requirments.id',
                'material_requirments.qty',
                'material_requirments.purpose',
                'material_requirments.status'
            )
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('material_requirments.created_at', [$startDate, $endDate]);
            })
            ->get();
        return view('materialrequest.mqadmin', compact('mq'));
    }

    public function approveStatus($id)
    {
        $data = ModelsMaterialRequirment::find($id);
        $data->status = 1;
        $data->save();
        return back();
    }

    public function pendingStatus($id)
    {
        $data = ModelsMaterialRequirment::find($id);
        $data->status = 0;
        $data->save();
        return back();
    }
}
