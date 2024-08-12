@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Property Amenity') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Property Amenity') }}</li>
@endsection



{{-- 
@section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection --}}


@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ url('property-amenity-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Amenity Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_checkin" class="form-control mt-2">
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
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Name</th>
                            <th>Timestamp</th>



                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($amenities as $amenity)
                            <tr x-data="{aname:'{{ $amenity->name }}'}">
                                <td>{{ $count }}</td>

                                <td>{{ $amenity->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($amenity->created_at)->format('d M,Y h:i A') }}</td>

                                <td class="text-end">
                                    <div class="gap-1" style="display: flex">
                                        <a data-bs-toggle="modal" data-bs-target="#edit_modal-{{ $amenity->id }}"
                                            data-id="{{ $amenity->id }}" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil text-white"></i> </a>
                                        {{-- <a class="dropdown-item" href="{{ route('invoices.show', $amenity) }}"><i
                                                class="fa fa-eye m-r-5"></i> View</a> --}}
                                        <a class="btn btn-sm btn-danger" x-on:click="fetchAmenity({{ $amenity->id }})" href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal" data-id="{{ $amenity->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="edit_modal-{{ $amenity->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Amenity {{ $amenity->id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <form action="{{ url('property-amenity-update', $amenity->id) }}"
                                                        method="post" >
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Amenity Name <span class="text-danger">*</span></label>
                                                            <input type="text" x-bind:value="aname" name="name" id="edit_checkin"
                                                                class="form-control mt-2">
                                                        </div>



                                                        {{-- <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%">{{ $amenity->note }}</textarea>
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

                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header text-start">
                                                        {{-- <h3>Delete {{ ucfirst($title) }}</h3> --}}
                                                        <p class="my-3">Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="{{ url('property-amenity-delete', $amenity->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Yes</button>
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
