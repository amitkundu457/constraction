@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Equipment') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Equipment') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="{{ route('equipment.register.index') }}" class="btn btn-sm btn-warning"  data-bs-toggle="tooltip" title="{{__('Assign')}}" >
            <i class="ti ti-paperclip"></i>
            <span>Assign</span>
        </a>
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
                            <th>Manufacturer</th>
                            <th>Quantity</th>
                            <th>Purchase Price</th>
                            <th>Purchase Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($equipments as $equipment)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $equipment->name }}</td>
                                <td>{{ $equipment->equipmentType->name }}
                                <td>{{ $equipment->equipmentManufacturer->name }}
                                </td>
                                <td>{{ $equipment->quantity }}</td>
                                <td>

                                    &#8377;{{ number_format($equipment->purchase_price) }}
                                </td>


                                <td>{{ Carbon\Carbon::parse($equipment->purchase_date)->format('d M,Y') }}</td>
                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $equipment->id }}" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        {{-- <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ route('equipment.update', $equipment->id) }}">
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
                                            data-bs-target="#delete_modal-{{ $equipment->id }}"
                                            data-id="{{ $equipment->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $equipment->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('equipment.delete', $equipment->id) }}"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $equipment->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit equipment</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('equipment.update', $equipment->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $equipment->name }}" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_type_id" id=""
                                                                    required>
                                                                    <option value="">Select Equipment Type</option>
                                                                    @foreach ($types as $type)
                                                                        <option value="{{ $type->id }}"
                                                                            @selected($equipment->equipment_type_id == $type->id)>
                                                                            {{ $type->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Quantity<span class="text-danger">*</span></label>
                                                                <input type="number" name="quantity" min="1"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="{{ $equipment->quantity }}" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Price<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="purchase_price" min="1"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="{{ $equipment->purchase_price }}"
                                                                    placeholder="">
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label> Model Number</label>
                                                                <input class="form-control" type="text"
                                                                    name="model_number" id=""
                                                                    placeholder="e.g GSB 18V-55"
                                                                    value="{{ $equipment->model_number }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Manufacturer <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_manufacturer_id"
                                                                    id="" required>
                                                                    <option value="">Select Manufacturer
                                                                    </option>
                                                                    @foreach ($manufacs as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            @selected($equipment->equipment_manufacturer_id == $item->id)>
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="purchase_date"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="{{ $equipment->purchase_date }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Status <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="status"
                                                                    id="" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="0" @selected(!$equipment->status)>
                                                                        Maintainance</option>
                                                                    <option value="1" @selected($equipment->status)>
                                                                        Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Description</label>
                                                            <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%">{{ $equipment->description }}</textarea>
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
                        <h5 class="modal-title">Add Equipments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('equipment.store') }}" method="post">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_checkin" class="form-control" required
                                        value="{{ old('name') }}" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_type_id" id="" required>
                                        <option value="">Select Equipment Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Quantity<span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" min="1" id="edit_checkin"
                                        class="form-control" required value="{{ old('quantity') }}" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Purchase Price<span class="text-danger">*</span></label>
                                    <input type="number" name="purchase_price" min="1" id="edit_checkin"
                                        class="form-control" required value="{{ old('purchase_price') }}"
                                        placeholder="">
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label> Model Number</label>
                                    <input class="form-control" type="text" name="model_number" id=""
                                        placeholder="e.g GSB 18V-55">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Manufacturer <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_manufacturer_id"
                                        id="" required>
                                        <option value="">Select Equipment Type
                                        </option>
                                        @foreach ($manufacs as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Purchase Date <span class="text-danger">*</span></label>
                                    <input type="date" name="purchase_date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="" required>
                                        <option value="">Select Status</option>
                                        <option value="0">Maintainance</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Description</label>
                                <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                    style="width: 100%"></textarea>
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
