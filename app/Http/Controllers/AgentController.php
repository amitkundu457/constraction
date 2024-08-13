<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\CustomField;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all();
        return view('agents.index', compact('agents'));
    }

    public function create()
    {

        $customFields = CustomField::where('created_by', '=', Auth::user()->creatorId())->where('module', '=', 'user')->get();
        $user  = Auth::user();
        $roles = Role::where('created_by', '=', $user->creatorId())->where('name', '!=', 'client')->get()->pluck('name', 'id');
        if (Auth::user()->can('create user')) {
            $agency = Agency::all();
            return view('agents.create', compact('roles', 'customFields', 'agency'));
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $agent = new Agent();
        $agent['name'] = $request->name;
        $agent['contact'] = $request->contact;
        $agent['email'] = $request->email;
        $agent['dob'] = $request->dob;
        $agent['pan'] = $request->pan;
        $agent['adhaar'] = $request->adhaar;
        $agent['agency_id'] = $request->agency_id;
        $agent['address'] = $request->address;
        $agent['city'] = $request->city;
        $agent['state'] = $request->state;
        $agent['pincode'] = $request->pincode;
        $agent->save();
        return redirect()->back()->with('success', __('New agent details added'));
    }

    public function edit($id)
    {
        $agency = Agency::all();
        $agent = Agent::findOrFail($id);
        return view('agents.update', compact('agent','agency'));
        // $customFields = CustomField::where('created_by', '=', Auth::user()->creatorId())->where('module', '=', 'user')->get();
        // $user  = Auth::user();
        // $roles = Role::where('created_by', '=', $user->creatorId())->where('name','!=','client')->get()->pluck('name', 'id');
        // if(Auth::user()->can('create user'))
        // {
        // }
        // else
        // {
        //     return redirect()->back();
        // }
    }

    public function update($id, Request $request)
    {
        $agent = Agent::findOrFail($id);
        $agent['name'] = $request->name;
        $agent['contact'] = $request->contact;
        $agent['email'] = $request->email;
        $agent['dob'] = $request->dob;
        $agent['pan'] = $request->pan;
        $agent['adhaar'] = $request->adhaar;
        $agent['agency_id'] = $request->agency_id;
        $agent['address'] = $request->address;
        $agent['city'] = $request->city;
        $agent['state'] = $request->state;
        $agent['pincode'] = $request->pincode;
        $agent->save();
        return redirect()->back()->with('success', __('Agent details upded'));
    }

    public function destroy($id)
    {
        Agent::findOrFail($id)->delete();
        return redirect()->back()->with('success', __('Agent deleted!'));
    }
}
