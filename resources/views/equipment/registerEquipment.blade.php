@extends('layouts.admin')

@section('page-title')
    {{ __('Register Equipment') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Register Equipment') }}</li>
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
                            <th>Site Name</th>
                            <th>Location</th>
                            <th>Equipment Name</th>
                            <th>Quantity</th>
                            <th>Register Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($regeqps as $regeqp)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $regeqp->site->name }}</td>
                                <td>{{ $regeqp->location->name }}
                                <td>{{ $regeqp->equipment->name }}
                                </td>
                                <td>{{ $regeqp->quantity }}</td>
                                <td>
                                    {{ Carbon\Carbon::parse($regeqp->date)->format('d M,Y') }}
                                </td>


                                {{-- <td>{{ Carbon\Carbon::parse($equipment->purchase_date)->format('d M,Y') }}</td> --}}
                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $regeqp->id }}" data-bs-toggle="modal"
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
                                            data-bs-target="#delete_modal-{{ $regeqp->id }}"
                                            data-id="{{ $regeqp->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $regeqp->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('equipment.register.delete', $regeqp->id) }}"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $regeqp->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Registered Equipment</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('equipment.register.update', $regeqp->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Equipment <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_id"
                                                                    id="" required>
                                                                    <option value="">Select Equipment</option>
                                                                    @foreach ($eqps as $eqp)
                                                                        <option value="{{ $eqp->id }}" @selected($regeqp->equipment_id == $eqp->id)>
                                                                            {{ $eqp->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Project <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="project_id"
                                                                    id="" required>
                                                                    <option value="">Select Project</option>
                                                                    @foreach ($projects as $project)
                                                                        <option value="{{ $project->id }}" @selected($regeqp->project_id == $project->id)>
                                                                            {{ $project->project_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Site <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="warehouse_id"
                                                                    id="" required>
                                                                    <option value="">Select Site</option>
                                                                    @foreach ($sites as $item)
                                                                        <option value="{{ $item->id }}" @selected($regeqp->warehouse_id == $item->id)>
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Location <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vender_id" id=""
                                                                    required>
                                                                    <option value="">Select Location</option>
                                                                    @foreach ($locations as $item)
                                                                        <option value="{{ $item->id }}" @selected($regeqp->vender_id == $item->id)>
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Quantity<span class="text-danger">*</span></label>
                                                                <input type="number" name="quantity" min="1"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="{{ $regeqp->quantity }}" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Registered Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="date" id="edit_checkin"
                                                                    class="form-control" required value="{{ $regeqp->date }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Description</label>
                                                            <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%">{{ $regeqp->description }}</textarea>
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
                        <h5 class="modal-title">Register Equipments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('equipment.register.store') }}" method="post">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Equipment <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_id" id="" required>
                                        <option value="">Select Equipment</option>
                                        @foreach ($eqps as $eqp)
                                            <option value="{{ $eqp->id }}">{{ $eqp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Project <span class="text-danger">*</span></label>
                                    <select class="form-control" name="project_id" id="" required>
                                        <option value="">Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Site <span class="text-danger">*</span></label>
                                    <select class="form-control" name="warehouse_id" id="" required>
                                        <option value="">Select Site</option>
                                        @foreach ($sites as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Location <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vender_id" id="" required>
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}</option>
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
                                    <label> Registered Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="edit_checkin" class="form-control"
                                        required>
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
