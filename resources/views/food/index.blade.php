@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Products') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Product') }}</li>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Site</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $count++ }}</td>

                                <td><img width="50"
                                        src="{{ Storage::url($product->image ?? 'uploads/food/no-image.png') }}"
                                        alt=""></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->vender->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->unit->name }}</td>
                                <td>{{ $product->category->name }}</td>





                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-{{ $product->id }}" data-bs-toggle="modal"
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
                                            data-bs-target="#delete_modal-{{ $product->id }}"
                                            data-id="{{ $product->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{ $product->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="{{ route('food.product.destroy', $product->id) }}"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-{{ $product->id }}"
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
                                                    <form action="{{ route('food.product.update',$product->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $product->name }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Site <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vender_id" id="" required>
                                                                    <option value="">Select site</option>
                                                                    @foreach ($venders as $vender)
                                                                        <option value="{{ $vender->id }}" @selected($vender->id == $product->vender_id)>{{ $vender->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Quantity <span class="text-danger">*</span></label>
                                                                <input type="text" name="price" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="{{ $product->price }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Unit <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="food_unit_id"
                                                                    id="" required>
                                                                    <option value="">Select unit</option>
                                                                    @foreach ($units as $unit)
                                                                        <option value="{{ $unit->id }}"
                                                                            @selected($product->food_unit_id == $unit->id)>
                                                                            {{ $unit->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Category <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="food_category_id"
                                                                    id="" required>
                                                                    <option value="">Select category</option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}" @selected($product->food_category_id == $category->id)>
                                                                            {{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Image</label>
                                                                <input type="file" name="file" id="edit_checkin"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Description <span class="text-danger">*</span></label>
                                                            <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%">{{ $product->description }}</textarea>
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
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('food.product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_checkin" class="form-control" required
                                        value="{{ old('name') }}">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Site <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vender_id" id="" required>
                                        <option value="">Select site</option>
                                        @foreach ($venders as $vender)
                                            <option value="{{ $vender->id }}">{{ $vender->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Quantity <span class="text-danger">*</span></label>
                                    <input type="text" name="price" id="edit_checkin" class="form-control" required
                                        value="{{ old('price') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Unit <span class="text-danger">*</span></label>
                                    <select class="form-control" name="food_unit_id" id="" required>
                                        <option value="">Select unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="food_category_id" id="" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Image</label>
                                    <input type="file" name="file" id="edit_checkin" class="form-control"
                                        value="{{ old('file') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
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
