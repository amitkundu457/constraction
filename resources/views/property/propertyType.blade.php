@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Property Type') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Property Type') }}</li>
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
                            <th>Plot Name</th>
                            <th>Description</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($type as $propertie)
                            <tr>
                                <td>{{ $count }}</td>

                                <td>{{ $propertie->type_name }}</td>
                                <td>{{ $propertie->plot($propertie->plot_id)->name }}</td>
                                <td>{{ $propertie->note }}</td>




                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-toggle="modal" data-target="#edit_modal-{{ $propertie->id }}"
                                            data-id="{{ $propertie->id }}" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil text-white"></i> </a>
                                        {{-- <a class="dropdown-item" href="{{ route('invoices.show', $propertie) }}"><i
                                                class="fa fa-eye m-r-5"></i> View</a> --}}
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#delete_modal" data-id="{{ $propertie->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="edit_modal-{{ $propertie->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Type {{ $propertie->id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('property-type-update', $propertie->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="{{ $propertie->type_name }}" type="text"
                                                                name="type_name" id="edit_checkin" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label> Plot Details<span class="text-danger">*</span></label>
                                                            <select type="text" name="plot_id" id="edit_checkin" class="form-control">
                                                                <option value="">Select Plot</option>
                                                                @foreach ($plots as $plot)
                                                                    <option value="{{ $plot->id }}">{{ $plot->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%">{{ $propertie->note }}</textarea>
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
                                    <div class="modal custom-modal fade" id="edit_modal-{{ $propertie->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Type {{ $propertie->id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('property-type-update', $propertie->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="{{ $propertie->type_name }}" type="text"
                                                                name="type_name" id="edit_checkin" class="form-control">
                                                        </div>



                                                        <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%">{{ $propertie->note }}</textarea>
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
                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        {{-- <h3>Delete {{ ucfirst($title) }}</h3> --}}
                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="{{ url('property-type-delete', $propertie->id) }}"
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
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-center">
                            {{-- {{ $type->links() }} --}}
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Property Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('property-type-store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label> Title <span class="text-danger">*</span></label>
                                <input type="text" name="type_name" id="edit_checkin" class="form-control">
                            </div>

                            <div class="form-group">
                                <label> Plot Details<span class="text-danger">*</span></label>
                                <select type="text" name="plot_id" id="edit_checkin" class="form-control">
                                    <option value="">Select Plot</option>
                                    @foreach ($plots as $plot)
                                        <option value="{{ $plot->id }}">{{ $plot->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label> Notes<span class="text-danger">*</span></label>
                                <textarea name="note" id="" cols="3" rows="2" style="width: 100%"></textarea>
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
