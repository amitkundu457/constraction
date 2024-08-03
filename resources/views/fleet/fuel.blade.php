@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Fuel') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Fuel') }}</li>
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
                            <th>Vehicle</th>
                            <th>Driver</th>
                            <th>Fill Date</th>
                            <th>Amount</th>
                            <th>Quantity (Litre)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($fuels as $fuel)
                            <tr>
                                <td>{{ $count++ }}</td>

                                <td>{{ $fuel->vehicle->vehicleType->name.' / '.$fuel->vehicle->number . ' - ' . $fuel->vehicle->code }}</td>
                                <td>{{ $fuel->driver->name }}</td>
                                <td>{{ Carbon\Carbon::parse($fuel->fill_date)->format('d M, Y') }}</td>
                                <td>&#8377; {{ number_format($fuel->amount) }}</td>
                                <td>
                                    {{ $fuel->quantity }}
                                </td>

                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $fuel->id }}" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary text-light"><i class="ti ti-pencil"></i> </a>
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
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-{{ $fuel->id }}"
                                            data-id="{{ $fuel->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $fuel->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('vehicle.fuel.delete', $fuel->id) }}"
                                                        method="post">
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $fuel->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Booking</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('vehicle.fuel.update', $fuel->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Vehicle <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vehicle_id"
                                                                    id="" required>
                                                                    <option value="">-- Select Vehicle --</option>
                                                                    @foreach ($vehicles as $vehicle)
                                                                        <option value="{{ $vehicle->id }}" @selected($fuel->vehicle_id == $vehicle->id)>
                                                                            {{ $vehicle->vehicleType->name . ' / ' . $vehicle->number . ' - ' . $vehicle->code }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Driver <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="driver_id" id=""
                                                                    required>
                                                                    <option value="">-- Select Driver --</option>
                                                                    @foreach ($drivers as $driver)
                                                                        <option value="{{ $driver->id }}" @selected($fuel->driver_id == $driver->id)>
                                                                            {{ $driver->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Fill Date <span class="text-danger">*</span></label>
                                                                <input type="date" name="fill_date" id="edit_checkin"
                                                                    class="form-control" required value="{{ $fuel->fill_date }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Quantity (Litre) <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="quantity" id="edit_checkin"
                                                                    class="form-control" required value="{{ $fuel->quantity }}">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Odometer Reading <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="odometer" id="edit_checkin"
                                                                    class="form-control" required value="{{ $fuel->odometer }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Amount <span class="text-danger">*</span></label>
                                                                <input type="number" name="amount" id="edit_checkin"
                                                                    class="form-control" required value="{{ $fuel->amount }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label>Notes <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" name="notes" id="" rows="3">{{ $fuel->notes }}</textarea>
                                                            </div>
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
                        <h5 class="modal-title">Add Fuel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('vehicle.fuel.store') }}" method="post">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Vehicle <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vehicle_id" id="" required>
                                        <option value="">-- Select Vehicle --</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">
                                                {{ $vehicle->vehicleType->name . ' / ' . $vehicle->number . ' - ' . $vehicle->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Driver <span class="text-danger">*</span></label>
                                    <select class="form-control" name="driver_id" id="" required>
                                        <option value="">-- Select Driver --</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Fill Date <span class="text-danger">*</span></label>
                                    <input type="date" name="fill_date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Quantity (Litre) <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Odometer Reading <span class="text-danger">*</span></label>
                                    <input type="number" name="odometer" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Notes <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="notes" id="" rows="3"></textarea>
                                </div>
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
        // $(document).ready(function() {
        //     $('.deletebtn').on('click', function() {
        //         var id = $(this).data('id');
        //         $('#delete_id').val(id);
        //     });
        // });
    </script>
@endsection
