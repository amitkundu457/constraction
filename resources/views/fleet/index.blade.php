@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Promotion') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Promotion') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
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
                            <th>Type</th>
                            <th>Code</th>
                            <th>Number</th>
                            <th>Fuel Type</th>
                            <th>Purchased</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $count++ }}</td>

                                <td>{{ $vehicle->vehicleType->name }}</td>
                                <td>{{ $vehicle->code }}</td>
                                <td>{{ $vehicle->number }}</td>
                                <td>
                                    @if ($vehicle->fuel_type == 0)
                                        {{ __('Diesel') }}
                                    @elseif($vehicle->fuel_type == 1)
                                        {{ __('CNG') }}
                                    @elseif($vehicle->fuel_type == 2)
                                        {{ __('Petrol') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($vehicle->status == 0)
                                        <span class="badge badge-danger text-danger">Sold</span>
                                    @elseif($vehicle->status == 1)
                                        <span class="badge badge-secondary text-secondary">Under Maintainance</span>
                                    @elseif($vehicle->status == 2)
                                        <span class="badge badge-primary text-primary">Active</span>
                                    @endif
                                </td>

                                <td>{{ Carbon\Carbon::parse($vehicle->purchase_date)->format('d M,Y') }}</td>
                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $vehicle->id }}" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        {{-- <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ route('vehicle.update', $vehicle->id) }}">
                                            <i class="ti ti-file"></i>
                                        </a> --}}
                                        {{-- <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ url('property-photo', $propertie->id) }}">
                                            <i class="ti ti-file"></i>
                                        </a> --}}
                                        {{-- <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"><i
                                                class="fa fa-eye m-r-5"></i> </a> --}}
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete_modal-{{ $vehicle->id }}"
                                            data-id="{{ $vehicle->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $vehicle->id }}" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        {{-- <h3>Delete {{ ucfirst($title) }}</h3> --}}
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete this record?</h5>
                                                        
                                                    </div>
                                                    <form action="{{ route('vehicle.delete', $vehicle->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" data-dismiss="modal"
                                                                        class="btn btn-danger cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $vehicle->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Vehicle</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('vehicle.update',$vehicle->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-group ">
                                                            <label> Vehicle Type <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="vehicle_type_id" required
                                                                id="">
                                                                <option value="">Select Vehicle Type</option>
                                                                @foreach ($vehicleTypes as $type)
                                                                    <option value="{{ $type->id }}"
                                                                        @selected($vehicle->vehicle_type_id == $type->id)>
                                                                        {{ $type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Vehicle Code <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="code" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $vehicle->code }}" placeholder="e.g. VC457">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Vehicle Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="number" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $vehicle->number }}"
                                                                    placeholder="e.g. WBXXXXX">
                                                            </div>

                                                        </div>
                                                        {{-- <input type="hidden" name="id" id="edit_id"> --}}

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Date<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="date"
                                                                    name="purchase_date" id="" required
                                                                    value="{{ $vehicle->purchase_date }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Amount<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="number"
                                                                    name="purchase_amount" id="" required
                                                                    value="{{ $vehicle->purchase_amount }}">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Fuel Type<span class="text-danger">*</span></label>
                                                                <select class="form-control" name="fuel_type"
                                                                    id="" required>
                                                                    <option value="">Select Fuel Type</option>
                                                                    <option value="0" @selected($vehicle->fuel_type == 0)>
                                                                        Diesel</option>
                                                                    <option value="1" @selected($vehicle->fuel_type == 1)>CNG
                                                                    </option>
                                                                    <option value="2" @selected($vehicle->fuel_type == 2)>
                                                                        Petrol</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> KMPL <span class="text-danger">*</span></label>
                                                                <input type="number" name="kmpl" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $vehicle->kmpl }}">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Start Meter Reading <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="start_meter_reading"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="{{ $vehicle->start_meter_reading }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Status <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="status"
                                                                    id="" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="0" @selected($vehicle->status == 0)>
                                                                        Sold</option>
                                                                    <option value="1" @selected($vehicle->status == 1)>
                                                                        Under Maintainance</option>
                                                                    <option value="2" @selected($vehicle->status == 2)>
                                                                        Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="notes" id="" class="form-control" cols="3" rows="2" style="width: 100%">{{ $vehicle->notes }}</textarea>
                                                        </div>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vehicle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('vehicle.store') }}" method="post">
                            @csrf
                            <div class="form-group ">
                                <label> Vehicle Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="vehicle_type_id" id="" required>
                                    <option value="">Select Vehicle Type</option>
                                    @foreach ($vehicleTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Vehicle Code <span class="text-danger">*</span></label>
                                    <input type="text" name="code" id="edit_checkin" class="form-control" required
                                        value="{{ old('code') }}" placeholder="e.g. VC457">
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Vehicle Number <span class="text-danger">*</span></label>
                                    <input type="text" name="number" id="edit_checkin" class="form-control" required
                                        value="{{ old('number') }}" placeholder="e.g. WBXXXXX">
                                </div>

                            </div>
                            {{-- <input type="hidden" name="id" id="edit_id"> --}}

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label> Purchase Date<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="purchase_date" id=""
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Purchase Amount<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="purchase_amount" id=""
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Fuel <span class="text-danger">*</span></label>
                                    <select class="form-control" name="fuel_type" id="" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="0">Diesel</option>
                                        <option value="1">CNG</option>
                                        <option value="2">Petrol</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> KMPL <span class="text-danger">*</span></label>
                                    <input type="number" name="kmpl" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Start Meter Reading <span class="text-danger">*</span></label>
                                    <input type="number" name="start_meter_reading" id="edit_checkin"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="" required>
                                        <option value="">Select Status</option>
                                        <option value="0">Sold</option>
                                        <option value="1">Under Maintainance</option>
                                        <option value="2">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Notes</label>
                                <textarea name="notes" id="" class="form-control" cols="3" rows="2" style="width: 100%"></textarea>
                            </div>
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
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
