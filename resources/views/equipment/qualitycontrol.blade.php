@extends('layouts.admin')

@section('page-title')
    {{ __('Verification Method') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('equipments.index') }}">{{ __('Equipment') }}</a></li>
    <li class="breadcrumb-item">{{ __('Verification') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        {{-- <a href="{{ route('equipment.register.index') }}" class="btn btn-sm btn-warning"  data-bs-toggle="tooltip" title="{{__('Assign')}}" >
            <i class="ti ti-paperclip"></i>
        </a> --}}
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
                            <th>ID</th>
                            <th>Equipment</th>
                            {{-- <th>Equipment Type</th> --}}
                            <th>Manufacturer</th>
                            <th>Verification Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($quals as $qual)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $qual->equipment->name }}</td>
                                
                                <td>{{ $qual->equipment->equipmentManufacturer->name }}
                                </td>
                                <td>
                                    {{ $qual->verification_method }}</td>
                                </td>


                                {{-- <td>{{ Carbon\Carbon::parse($equipment->purchase_date)->format('d M,Y') }}</td> --}}
                                {{-- <td>{{ date_format(date_create($propertie->edate), 'd M, Y') }}</td> --}}


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $qual->id }}" data-bs-toggle="modal"
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
                                            data-bs-target="#delete_modal-{{ $qual->id}}"
                                            data-id="{{ $qual->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $qual->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('equipment.quality.delete', $qual->id) }}"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $qual->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Verification Method</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('equipment.quality.update', $qual->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_id" id="" required>
                                                                    <option value="">--Select Equipment--</option>
                                                                    @foreach ($eqps as $eqp)
                                                                        <option value="{{ $eqp->id }}" @selected($qual->equipment_id == $eqp->id)>{{ $eqp->name }}</option>
                                                                    @endforeach
                            
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Verification Method <span class="text-danger">*</span></label>
                                                                <input type="text" name="verification_method" id="edit_checkin" class="form-control" required
                                                                    value="{{ $qual->verification_method }}" placeholder="">
                                                            </div>
                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Acceptance Criteria <span class="text-danger">*</span></label>
                                                            <textarea name="acceptance_criteria" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%" required>{{$qual->acceptance_criteria}}</textarea>
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
                        <h5 class="modal-title">Add Verification Method</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('equipment.quality.store') }}" method="post">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_id" id="" required>
                                        <option value="">--Select Equipment--</option>
                                        @foreach ($eqps as $eqp)
                                            <option value="{{ $eqp->id }}">{{ $eqp->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Verification Method <span class="text-danger">*</span></label>
                                    <input type="text" name="verification_method" id="edit_checkin" class="form-control" required
                                        value="{{ old('verification_method') }}" placeholder="">
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Acceptance Criteria <span class="text-danger">*</span></label>
                                <textarea name="acceptance_criteria" id="" class="form-control" cols="3" rows="2"
                                    style="width: 100%" required></textarea>
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
