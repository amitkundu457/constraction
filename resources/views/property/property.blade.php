@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Property') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Property') }}</li>
@endsection



@section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Contract</th>
                            <th>Status</th>
                            <th> TimeStamp</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($properties as $propertie)
                            <tr>
                                <td>{{ $count }}</td>

                                <td>{{ $propertie->title }}</td>
                                <td>{{ $propertie->property_type }}</td>
                                <td>{{ $propertie->contract_type }}</td>
                                <td>
                                    @if ($propertie->status == 0)
                                        <span class="badge badge-danger text-danger">Sold</span>
                                    @elseif($propertie->status == 1)
                                        <span class="badge text-primary">Available</span>
                                    @elseif($propertie->status == 2)
                                        <span class="badge text-warning">Pending</span>
                                    @endif
                                </td>


                                <td>{{ date_format(date_create($propertie->date), 'd M, Y') }}
                                    {{ date('g:i A', strtotime($propertie->time)) }}</td>
                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $propertie->id }}" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ url('property-document', $propertie->id) }}">
                                            <i class="ti ti-file"></i>
                                        </a>
                                        {{-- <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ url('property-photo', $propertie->id) }}">
                                            <i class="ti ti-file"></i>
                                        </a> --}}
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"><i
                                                class="fa fa-eye m-r-5"></i> </a>
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#delete_modal"
                                            data-id="{{ $propertie->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        {{-- <h3>Delete {{ ucfirst($title) }}</h3> --}}
                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="{{ url('property-delete', $propertie->id) }}"
                                                        method="get">
                                                        {{-- @method('DELETE') --}}
                                                        @csrf
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <button data-dismiss="modal"
                                                                        class="btn btn-primary cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $propertie->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property</h5>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('property-update', $propertie->id) }}"
                                                        method="post" x-data="{ ptype: null }">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Property Title <span class="text-danger">*</span></label>
                                                            <input type="text" value="{{ $propertie->title }}"
                                                                name="title" id="edit_checkin" class="form-control">
                                                        </div>

                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Property Type <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="property_type"
                                                                    id=""
                                                                    x-on:change="ptype = $event.target.options[$event.target.selectedIndex].dataset.type.toLowerCase()">
                                                                    <option value="">Select Property Type</option>
                                                                    @foreach ($type as $types)
                                                                        <option value="{{ $types->id }}"
                                                                            data-type="{{ $types->type_name }}"
                                                                            @selected($propertie->property_type_id == $types->id)>
                                                                            {{ $types->type_name }} -
                                                                            {{ $types->plot($types->plot_id)->name }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label> Location <span class="text-danger">*</span></label>
                                                                <input type="text" value="{{ $propertie->location }}"
                                                                    name="location" id="edit_checkin" class="form-control">
                                                            </div>

                                                        </div>
                                                        {{-- <input type="hidden" name="id" id="edit_id"> --}}


                                                        <div class="form-group">
                                                            <label> Address <span class="text-danger">*</span></label>
                                                            <textarea name="address" id="" cols="" rows="5" class="form-control">{{ $propertie->address }}</textarea>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group"
                                                                :class="ptype !== ('apartment' || 'flat') ? 'col-md-6' :
                                                                    'col-md-4'">
                                                                <label> Price <span class="text-danger">*</span></label>
                                                                <input type="text" value="{{ $propertie->price }}"
                                                                    name="price" id="edit_checkin"
                                                                    class="form-control">
                                                            </div>
                                                            <template x-if="ptype !== ('apartment'||'flat')">
                                                                <div class="form-group col-md-6">
                                                                    <label> Area <span class="text-danger">*</span></label>
                                                                    <input type="text" value="{{ $propertie->area }}"
                                                                        name="area" id="edit_checkin"
                                                                        class="form-control">
                                                                </div>
                                                            </template>
                                                            <template x-if="ptype === ('apartment'||'flat')">
                                                                <div class="form-group col-md-4">
                                                                    <label> BHK <span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="bhk_id"
                                                                        id="">
                                                                        <option value="">--Select BHK--</option>
                                                                        @foreach ($bhks as $bhk)
                                                                            <option value="{{ $bhk->id }}"
                                                                                @selected($propertie->bhk_id == $bhk->id)>
                                                                                {{ $bhk->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </template>
                                                            <template x-if="ptype === ('apartment' || 'flat')">
                                                                <div class="form-group col-md-4">
                                                                    <label> Unit <span class="text-danger">*</span></label>
                                                                    <select class="form-control" name="unit_id"
                                                                        id="">
                                                                        <option value="">Select Unit</option>
                                                                        @foreach ($unit as $area)
                                                                            <option value="{{ $area->id }}"
                                                                                @selected($propertie->unit_id == $area->id)>
                                                                                {{ $area->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </template>

                                                        </div>

                                                        <div class="row" x-data="{ ctype: {{ $propertie->ctype }} || 1, agents: [], getAgents(id) { fetch(`/agency/${id}`).then((res) => res.json()).then((data) => this.agents = data.agents) } }">
                                                            <div class="form-group"
                                                                :class="ctype == 1 ? 'col-md-6' : 'col-md-4'">
                                                                <label>Contact Type <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control"
                                                                    x-on:change="ctype = $event.target.value"
                                                                    name="ctype" id="">
                                                                    <option value="1" @selected($propertie->ctype == 1)>Direct</option>
                                                                    <option value="2" @selected($propertie->ctype == 2)>Agency</option>
                                                                </select>
                                                            </div>
                                                            <template x-if="ctype == 2">
                                                                <div class="form-group col-md-4" x-init="getAgents({{ $propertie->agency_id }})">
                                                                    <label>Agency <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-control"
                                                                        x-on:change="getAgents($event.target.value)"
                                                                        name="agency_id" id="">
                                                                        <option value="">Select Agency</option>
                                                                        @foreach ($agency as $p)
                                                                            <option value="{{ $p->id }}" @selected($propertie->agency_id == $p->id)>
                                                                                {{ $p->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </template>
                                                            <div class="form-group"
                                                                :class="ctype == 1 ? 'col-md-6' : 'col-md-4'">
                                                                <label>Agent <span class="text-danger">*</span></label>
                                                                <template x-if="ctype == 1">
                                                                    <select class="form-control" name="agent_id"
                                                                        id="">
                                                                        <option value="">Select Agent</option>
                                                                        @foreach ($agents as $agent)
                                                                            <option value="{{ $agent->id }}">
                                                                                {{ $agent->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </template>
                                                                <template x-if="ctype == 2">
                                                                    <select class="form-control" name="agency_id"
                                                                        id="">
                                                                        <template x-for="agent in agents">
                                                                            <option :value="agent.id"
                                                                                x-text="agent.name"></option>
                                                                        </template>
                                                                    </select>
                                                                </template>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Contract <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="contract_type"
                                                                    id="">
                                                                    <option value="">Select Contract</option>
                                                                    @foreach ($contruct as $contract)
                                                                        <option value="{{ $contract->id }}"
                                                                            @selected($propertie->contract_type == $contract->contruct_name)>
                                                                            {{ $contract->contruct_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Status <span class="text-danger">*</span></label>
                                                                <select name="status" id=""
                                                                    class="form-control">
                                                                    <option value=""> Select Listing Status</option>
                                                                    <option value="0" @selected($propertie->status == '0')>
                                                                        Sold</option>
                                                                    <option value="1" @selected($propertie->status == '1')>
                                                                        Active</option>
                                                                    <option value="2" @selected($propertie->status == '2')>
                                                                        Pending</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{-- <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label> Number of Floors <span class="text-danger">*</span></label>
                                                                <input type="text" name="floor" id="edit_checkin" value="{{ $propertie->floor }}" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> No of Bedrooms <span class="text-danger">*</span></label>
                                                                <input type="number" name="bedroom" value="{{ $propertie->bedroom }}" class="form-control" id="">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Number of Bathrooms <span class="text-danger">*</span></label>
                                                                <input type="text" name="bathroom" value="{{ $propertie->bathroom }}" id="edit_checkin" class="form-control">
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label> Add Documents <span class="text-danger">*</span></label>
                                                                <input type="file" name="document" id="edit_checkin" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Add Photo <span class="text-danger">*</span></label>
                                                                <input type="file" name="photo" id="edit_checkin" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Add Floor Plan <span class="text-danger">*</span></label>
                                                                <input type="file" name="plan" id="edit_checkin" class="form-control">
                                                            </div>
                                                        </div> --}}
                                                        <div class=" row">
                                                            <div class="form-group col-md-8">
                                                                <p style="font-weight: 600">Amenity</p>
                                                                <div class="d-flex gap-2 align-items-center flex-wrap">

                                                                    @foreach ($amenities as $amenity)
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                value="{{ $amenity->id }}"
                                                                                @checked(isset($propertie->amenities) && in_array($amenity->id, $propertie->amenities))
                                                                                name="amenities[]" id="flexCheckChecked">
                                                                            <label class="form-check-label"
                                                                                style="font-weight: 500"
                                                                                for="flexCheckChecked">
                                                                                {{ $amenity->name }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>

                                                        </div>


                                                        {{-- <div class="form-group d-flex flex-column">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%"></textarea>
                                                        </div> --}}
                                                        <div class="submit-section">
                                                            <button type="submit"
                                                                class="btn btn-primary submit-btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Property</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('property-store') }}" method="post" enctype="multipart/form-data"
                            x-data="{ ptype: null }">
                            @csrf
                            <div class="form-group">
                                <label>Property Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="edit_checkin" class="form-control">
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Property Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="property_type"
                                        x-on:change="ptype = $event.target.options[$event.target.selectedIndex].dataset.type.toLowerCase()"
                                        id="">
                                        <option value="">Select Property Type</option>
                                        @foreach ($type as $types)
                                            <option value="{{ $types->id }}" data-type="{{ $types->type_name }}">
                                                {{ $types->type_name }} - {{ $types->plot($types->plot_id)->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Location <span class="text-danger">*</span></label>
                                    <input type="text" name="location" id="edit_checkin" class="form-control">
                                </div>

                            </div>
                            {{-- <input type="hidden" name="id" id="edit_id"> --}}


                            <div class="form-group">
                                <label> Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="" cols="" rows="5" class="form-control"></textarea>
                            </div>
                            <div class=" row">
                                <div class="form-group" :class="ptype !== ('apartment' || 'flat') ? 'col-md-6' : 'col-md-4'">
                                    <label> Price <span class="text-danger">*</span></label>
                                    <input type="text" name="price" id="edit_checkin" class="form-control">
                                </div>
                                <template x-if="ptype !== ('apartment'||'flat')">
                                    <div class="form-group col-md-6">
                                        <label> Area <span class="text-danger">*</span></label>
                                        <input type="text" name="area" id="edit_checkin" class="form-control">
                                    </div>
                                </template>
                                <template x-if="ptype === ('apartment'||'flat')">
                                    <div class="form-group col-md-4">
                                        <label> BHK <span class="text-danger">*</span></label>
                                        <select class="form-control" name="bhk_id" id="">
                                            <option value="">--Select BHK--</option>
                                            @foreach ($bhks as $bhk)
                                                <option value="{{ $bhk->id }}">{{ $bhk->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </template>
                                <template x-if="ptype === ('apartment' || 'flat')">
                                    <div class="form-group col-md-4">
                                        <label> Unit <span class="text-danger">*</span></label>
                                        <select class="form-control" name="unit_id" id="">
                                            <option value="">Select Unit</option>
                                            @foreach ($unit as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </template>
                            </div>
                            <div class="row" x-data="{ ctype: 1, agents: [], getAgents(id) { fetch(`/agency/${id}`).then((res) => res.json()).then((data) => this.agents = data.agents) } }">
                                <div class="form-group" :class="ctype == 1 ? 'col-md-6' : 'col-md-4'">
                                    <label>Contact Type <span class="text-danger">*</span></label>
                                    <select class="form-control" x-on:change="ctype = $event.target.value" name="ctype"
                                        id="">
                                        <option value="1">Direct</option>
                                        <option value="2">Agency</option>
                                    </select>
                                </div>
                                <template x-if="ctype == 2">
                                    <div class="form-group col-md-4">
                                        <label>Agency <span class="text-danger">*</span></label>
                                        <select class="form-control" x-on:change="getAgents($event.target.value)"
                                            name="agency_id" id="">
                                            <option value="">Select Agency</option>
                                            @foreach ($agency as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </template>
                                <div class="form-group" :class="ctype == 1 ? 'col-md-6' : 'col-md-4'">
                                    <label>Agent <span class="text-danger">*</span></label>
                                    <template x-if="ctype == 1">
                                        <select class="form-control" name="agent_id" id="">
                                            <option value="">Select Agent</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </template>
                                    <template x-if="ctype == 2">
                                        <select class="form-control" name="agency_id" id="">
                                            <template x-for="agent in agents">
                                                <option :value="agent.id" x-text="agent.name"></option>
                                            </template>
                                        </select>
                                    </template>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Contract <span class="text-danger">*</span></label>
                                    <select class="form-control" name="contract_type" id="">
                                        <option value="">Select Contract</option>
                                        @foreach ($contruct as $contract)
                                            <option value="{{ $contract->id }}">{{ $contract->contruct_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Status <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value=""> Select Listing Status</option>
                                        <option value="0">Sold</option>
                                        <option value="1">Active</option>
                                        <option value="2">Pending</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class=" row">
                                <div class="form-group col-md-4">
                                    <label> Number of Floors <span class="text-danger">*</span></label>
                                    <input type="text" name="floor" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> No of Bedrooms <span class="text-danger">*</span></label>
                                    <input type="number" name="bedroom" class="form-control" id="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Number of Bathrooms <span class="text-danger">*</span></label>
                                    <input type="text" name="bathroom" id="edit_checkin" class="form-control">
                                </div>

                            </div> --}}
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label> Add Documents <span class="text-danger">*</span></label>
                                    <input type="file" name="document" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Add Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Add Floor Plan <span class="text-danger">*</span></label>
                                    <input type="file" name="plan" id="edit_checkin" class="form-control">
                                </div>
                            </div>
                            <div class=" row">
                                {{-- <div class="form-group col-md-4">
                                    <label>Parking Availability <span class="text-danger">*</span></label>
                                    <select name="parking" id="" class="form-control">
                                        <option value=""> Select Parking Availability</option>
                                        <option value="0">yes</option>
                                        <option value="1">No</option>
                                    </select>
                                </div> --}}

                                <div class="form-group col-md-8">
                                    <p style="font-weight: 600">Amenity</p>
                                    <div class="d-flex gap-2 align-items-center flex-wrap">
                                        @foreach ($amenities as $amenity)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $amenity->id }}" name="amenities[]"
                                                    id="flexCheckChecked">
                                                <label class="form-check-label" style="font-weight: 500"
                                                    for="flexCheckChecked">
                                                    {{ $amenity->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>


                            {{-- <div class="form-group">
                                <label> Notes<span class="text-danger">*</span></label>
                                <textarea name="note" id="" cols="3" rows="2" style="width: 100%"></textarea>
                            </div> --}}
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // $(document).ready(function() {
        //     $('.deletebtn').on('click', function() {
        //         var id = $(this).data('id');
        //         $('#delete_id').val(id);
        //     });
        // });

        // getAgents(id){

        // }

        // document.addEventListener("alpine:init",function(){
        //     Alpine.data('getAgents',getAgents)
        // })
    </script>
@endsection
