@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Products') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Manufacturer') }}</li>
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Product Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($manufacturers as $manu)
                            <tr>
                                <td>{{ $count++ }}</td>

                                <td>{{ $manu->name }}</td>
                                <td>{{ $manu->email }}</td>
                                <td>{{ $manu->phone }}</td>
                                <td>{{ $manu->category->name }}</td>
                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $manu->id }}" data-bs-toggle="modal"
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
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-{{ $manu->id }}"
                                            data-id="{{ $manu->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $manu->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('food.manufacturer.destroy', $manu->id) }}"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $manu->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('food.manufacturer.update',$manu->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $manu->name }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Email <span class="text-danger">*</span></label>
                                                                <input type="email" name="email" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $manu->email }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Phone <span class="text-danger">*</span></label>
                                                                <input type="tel" name="phone" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $manu->phone }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>City <span class="text-danger">*</span></label>
                                                                <input type="text" name="city" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $manu->city }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>State <span class="text-danger">*</span></label>
                                                                <input type="text" name="state" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $manu->state }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Category <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="food_category_id"
                                                                    id="" required>
                                                                    <option value="">Select category</option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}" @selected($manu->food_category_id == $category->id)>
                                                                            {{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address <span class="text-danger">*</span></label>
                                                            <textarea name="address" id="" class="form-control" cols="3" rows="2" style="width: 100%">{{ $manu->address }}</textarea>
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
                        <h5 class="modal-title">Add New Manufacturer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('food.manufacturer.store') }}" method="post">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_checkin" class="form-control" required
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="edit_checkin" class="form-control" required
                                        value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" id="edit_checkin" class="form-control" required
                                        value="{{ old('price') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="edit_checkin" class="form-control" required
                                        value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>State <span class="text-danger">*</span></label>
                                    <input type="text" name="state" id="edit_checkin" class="form-control" required
                                        value="{{ old('price') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="food_category_id" id="" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="" class="form-control" cols="3" rows="2" style="width: 100%"></textarea>
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
