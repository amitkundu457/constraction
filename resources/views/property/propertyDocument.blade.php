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

                            <th>document</th>



                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($document as $propertie)
                            <tr>
                                <td>{{ $count }}</td>

                                <td>
                                    @if ($propertie->document)
                                        <a href="{{ url('property-document-download', basename($propertie->document)) }}"
                                            class="btn btn-primary">Download</a>
                                    @else
                                        No document available
                                    @endif
                                </td>





                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-toggle="modal" data-bs-target="#edit_modal-{{ $propertie->id }}"
                                            data-id="{{ $propertie->id }}" class="btn btn-sm btn-primary"><i
                                                class="fa fa-eye " style="font-size: 0.7rem"></i> </a>

                                        <a class="btn btn-danger btn-sm align-middle" href="javascript:void(0)"
                                            style="margin-left:0.5rem" data-toggle="modal" data-target="#delete_modal"
                                            data-id="{{ $propertie->id }}">
                                            <i class="ti ti-trash text-white" style="font-size: 0.7rem;"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="edit_modal-{{ $propertie->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('document/' . $propertie->document) }}"
                                                        alt="">
                                                    {{-- <form action="{{ url('property-unit-update', $propertie->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="{{ $propertie->unit_name }}" type="text"
                                                                name="unit_name" id="edit_checkin" class="form-control">
                                                        </div>



                                                        {{-- <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%">{{ $propertie->note }}</textarea>
                                                        </div> --}}
                                                    {{-- <div class="submit-section">
                                                        <button type="submit"
                                                            class="btn btn-primary submit-btn">Submit</button>
                                                    </div>
                                                    </form> --}}
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
                                                    <form action="{{ url('property-unit-update', $propertie->id) }}"
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
                                                    <form action="{{ url('property-document-delete', $propertie->id) }}"
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
                        <h5 class="modal-title">Property document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('property-document-store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label> Title <span class="text-danger">*</span></label>
                                <input type="file" name="document" id="edit_checkin" class="form-control">
                                <input type="text" hidden name="property_id" value="{{ $pro->id }}"
                                    id="edit_checkin" class="form-control">
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
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
