@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Bookings') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Booking') }}</li>
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
                            <th>Vehicle Type</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $count++ }}</td>

                                <td>{{ $booking->vehicle->number.' - '.$booking->vehicle->code }}</td>
                                <td>{{ $booking->vehicleType->name }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>&#8377; {{ $booking->amount }}</td>
                                <td>
                                    {{ ucfirst(str_replace('_', ' ', $booking->type)) }}<i style="margin-left: 5px" class="{{$booking->type == 'single_trip' ? __('ti ti-arrow-up text-danger') : __('ti ti-arrows-sort text-info')}}"></i>
                                </td>
                                <td>
                                    @if ($booking->status == 'yet_to_start')
                                        <span
                                            class="badge badge-info bg-info text-light">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                    @elseif($booking->status == 'complete')
                                        <span
                                            class="badge badge-success bg-success text-light">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                    @elseif($booking->status == 'ongoing')
                                        <span
                                            class="badge badge-warning bg-warning text-dark">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span
                                            class="badge badge-danger bg-danger text-light">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                    @endif
                                </td>

                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $booking->id }}" data-bs-toggle="modal"
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
                                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete_modal-{{ $booking->id }}"
                                            data-id="{{ $booking->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $booking->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('vehicle.booking.delete', $booking->id) }}"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $booking->id }}"
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
                                                    <form action="{{ route('vehicle.booking.update', $booking->id) }}"
                                                        method="post" x-data="loadvehicle()">
                                                        @csrf
                                                        @method('put')
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Customer <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="user_id" id=""
                                                                    required>
                                                                    <option value="">-- Select Customer --</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}"
                                                                            @selected($booking->user_id == $user->id)>
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4" x-init="getVehicle({{ $booking->vehicle_type_id }})">
                                                                <label>Vehicle Type <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control"
                                                                    @change="getVehicle($event.target.value)"
                                                                    name="vehicle_type_id" id="" required>
                                                                    <option value="">-- Select Vehicle Type --
                                                                    </option>
                                                                    @foreach ($vtypes as $vtype)
                                                                        <option value="{{ $vtype->id }}"
                                                                            @selected($booking->vehicle_type_id == $vtype->id)>
                                                                            {{ $vtype->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Vehicle <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vehicle_id"
                                                                    id="" required>
                                                                    <template x-if="vehicles">
                                                                        <template x-for="vehicle in vehicles">
                                                                            <option :value="vehicle.id"
                                                                                x-text="vehicle.number+' - '+vehicle.code"
                                                                                :selected="{{ $booking->vehicle_id }} == vehicle
                                                                                    .id">
                                                                            </option>
                                                                        </template>
                                                                    </template>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Driver <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="driver_id" id=""
                                                                    required>
                                                                    <option value="">-- Select Driver --</option>
                                                                    @foreach ($drivers as $driver)
                                                                        <option value="{{ $driver->id }}" @selected($booking->driver_id == $driver->id)>
                                                                            {{ $driver->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="type" id=""
                                                                    required>
                                                                    <option value="">-- Select Trip Type --</option>
                                                                    <option value="single_trip" @selected($booking->type == 'single_trip')>{{ __('Single Trip') }}
                                                                    </option>
                                                                    <option value="round_trip" @selected($booking->type == 'round_trip')>{{ __('Round Trip') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Status <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="status" id=""
                                                                    required>
                                                                    <option value="">-- Select Status --</option>
                                                                    <option value="yet_to_start" @selected($booking->status == 'yet_to_start')>Yet To Start</option>
                                                                    <option value="completed" @selected($booking->status == 'complete')>Completed</option>
                                                                    <option value="ongoing" @selected($booking->status == 'ongoing')>On Going</option>
                                                                    <option value="cancelled" @selected($booking->status == 'cancelled')>Cancelled</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Start Location<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="text"
                                                                    name="start_location" id="" required value="{{ $booking->start_location }}" >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip End Location<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="text"
                                                                    name="end_location" id="" required value="{{ $booking->end_location }}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Amount <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="amount" id="edit_checkin"
                                                                    class="form-control" required value="{{ $booking->amount }}">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Start Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="start_date" id="edit_checkin"
                                                                    class="form-control" required value="{{ $booking->start_date }}">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip End Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="end_date" id="edit_checkin"
                                                                    class="form-control" required value="{{ $booking->end_date }}">
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
                        <h5 class="modal-title">Create New Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('vehicle.booking.store') }}" method="post" x-data="loadvehicle()">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Customer <span class="text-danger">*</span></label>
                                    <select class="form-control" name="user_id" id="" required>
                                        <option value="">-- Select Customer --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" @change="getVehicle($event.target.value)"
                                        name="vehicle_type_id" id="" required>
                                        <option value="">-- Select Vehicle Type --</option>
                                        @foreach ($vtypes as $vtype)
                                            <option value="{{ $vtype->id }}">{{ $vtype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Vehicle <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vehicle_id" id="" required>
                                        <template x-if="vehicles">
                                            <template x-for="vehicle in vehicles">
                                                <option :value="vehicle.id" x-text="vehicle.number+' - '+vehicle.code">
                                                </option>
                                            </template>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Driver <span class="text-danger">*</span></label>
                                    <select class="form-control" name="driver_id" id="" required>
                                        <option value="">-- Select Driver --</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="type" id="" required>
                                        <option value="">-- Select Trip Type --</option>
                                        <option value="single_trip">{{ __('Single Trip') }}</option>
                                        <option value="round_trip">{{ __('Round Trip') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="yet_to_start">Yet To Start</option>
                                        <option value="completed">Completed</option>
                                        <option value="ongoing">On Going</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Trip Start Location<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="start_location" id=""
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip End Location<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="end_location" id=""
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Trip Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="end_date" id="edit_checkin" class="form-control"
                                        required>
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

        function loadvehicle() {
            return {
                vehicles: null,
                getVehicle(id) {
                    fetch(`/vehicle/vehicle-type/${id}`).then((res) => res.json()).then((data) => this.vehicles = data
                        .vehicles)
                }
            }
        }
    </script>
@endsection
