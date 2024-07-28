<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('company/company', compact('companies'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->status = 1;
        $company->save();
        return back()->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->save();
        return back()->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return back()->with('success', 'Company deleted successfully.');
    }

    // public function search(Request $request)
}
