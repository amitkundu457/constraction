@extends('layouts.admin')

@section('page-title')
    {{ __('Create Plot') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plot.index') }}">{{ __('Plot') }}</a></li>
    <li class="breadcrumb-item">{{ __('Create') }}</li>
@endsection

{{-- @section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection --}}



{{-- @section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection --}}

@section('content')
    <form  action="{{ route('plot.create') }}" class="mt-3" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class=" row">
            <div class="form-group col-md-6">
                <label>Owner Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="edit_checkin" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label> Phone no <span class="text-danger">*</span></label>
                <input type="tel" name="phone_no" id="edit_checkin" class="form-control">
            </div>

        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Project name <span class="text-danger">*</span></label>
                <input type="text" name="project_name" id="edit_checkin" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label> Block name <span class="text-danger">*</span></label>
                <input type="text" name="block_name" id="edit_checkin" class="form-control">
            </div>

        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Khasra No. <span class="text-danger">*</span></label>
                <input type="number" name="khasra_no" id="edit_checkin" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label> Mauza No <span class="text-danger">*</span></label>
                <input type="number" name="mauza_no" id="edit_checkin" class="form-control">
            </div>

        </div>
        {{-- <input type="hidden" name="id" id="edit_id"> --}}


        <div class="form-group">
            <label> Address <span class="text-danger">*</span></label>
            <textarea name="address" id="" cols="" rows="5" class="form-control"></textarea>
        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Amount <span class="text-danger">*</span></label>
                <input type="number" name="amount" id="edit_checkin" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label> Total Plots <span class="text-danger">*</span></label>
                <input type="number" min="0" name="total_plots" id="edit_checkin" class="form-control">
            </div>

        </div>
        {{-- <div class=" row">
        <div class="form-group col-md-6">
            <label> Contract <span class="text-danger">*</span></label>
            <select class="form-control" name="contract_type" id="">
                <option value="">Select Contract</option>
                {{-- @foreach ($contruct as $contract)
                    <option value="{{ $contract->id }}">{{ $contract->contruct_name }}</option>
                @endforeach 
            </select>
        </div>
        <div class="form-group col-md-6">
            <label> Area <span class="text-danger">*</span></label>
            <input type="text" name="area" id="edit_checkin" class="form-control">
        </div>

    </div> --}}

        {{-- <div class=" row">
        <div class="form-group col-md-6">
            <label> Unit <span class="text-danger">*</span></label>
            <select class="form-control" name="unit_id" id="">
                <option value="">Select Unit</option>
                {{-- @foreach ($unit as $area)
                    <option value="{{ $area->id }}">{{ $area->unit_name }}</option>
                @endforeach 
            </select>
        </div>
        <div class="form-group col-md-6">
            <label> Number of Floors <span class="text-danger">*</span></label>
            <input type="text" name="floor" id="edit_checkin" class="form-control">
        </div>

    </div> --}}
        {{-- <div class=" row">
        <div class="form-group col-md-6">
            <label> No of Bedrooms <span class="text-danger">*</span></label>
            <input type="number" name="bedroom" class="form-control" id="">
        </div>
        <div class="form-group col-md-6">
            <label> Number of Bathrooms <span class="text-danger">*</span></label>
            <input type="text" name="bathroom" id="edit_checkin" class="form-control">
        </div>

    </div> --}}
        <div class=" row" x-data="{files:1}">
            <label class="my-2" style="font-weight: 600"> Upload Documents<span class="text-danger">*</span></label>
            <div class="flex align-items-center">
                <button type="button" x-on:click="files += 1" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </button>
                <button x-show="files !== 1" type="button" x-on:click="files -= 1" class="btn btn-sm btn-danger">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Upload</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                        $count = 1;
                    @endphp --}}
                        <template x-for="(index,file) in files">
                            <tr>
                                <td x-text="index"></td>
                                <td>
                                    <input type="text" :name="`documents[${index}][name]`" class="form-control" placeholder="Enter document name">
                                </td>
                                <td>
                                    <select :name="`documents[${index}][type]`" id="" class="form-control" style="width: 100%">
                                        <option value=""> Select Type</option>
                                        <option value="image">Image</option>
                                        <option value="document">Document</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="file" :name="`documents[${index}][file]`" class="form-control" >
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            {{-- <div class="form-group col-md-6">
                <label> Status <span class="text-danger">*</span></label>
                
            </div> --}}
            {{-- <div class="form-group col-md-4">
            <label> Add Photo <span class="text-danger">*</span></label>
            <input type="file" name="photo" id="edit_checkin" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label> Add Floor Plan <span class="text-danger">*</span></label>
            <input type="file" name="plan" id="edit_checkin" class="form-control">
        </div> --}}
        </div>
        {{-- <div class=" row">
        <div class="form-group col-md-4">
            <label>Parking Availability <span class="text-danger">*</span></label>
            <select name="parking" id="" class="form-control">
                <option value=""> Select Parking Availability</option>
                <option value="0">yes</option>
                <option value="1">No</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label> Status <span class="text-danger">*</span></label>
            <select name="status" id="" class="form-control">
                <option value=""> Select Listing Status</option>
                <option value="0">Sold</option>
                <option value="1">Active</option>
                <option value="2">Pending</option>
            </select>
        </div>

    </div> --}}


        <div class="row" x-data="{dispute:false}">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Has Any Dispute<span class="text-danger">*</span></label>
                    <div class="my-3">
                        <div class="form-check">
                            <input class="form-check-input" x-on:change="dispute = true" name="is_dispute" type="radio" checked="dispute">
                            <label class="form-check-label"  style="font-weight: 500">
                               Yes
                              </label>
                          </div>
                          <div class="form-check mt-2">
                            <input class="form-check-input" x-on:change="dispute = false" name="is_dispute" type="radio" checked="!dispute">
                            <label class="form-check-label" for="exampleRadios3" style="font-weight: 500">
                                No
                              </label>
                          </div>
                    </div>
                </div>
            </div>
            <div  class="col-md-6">
                <div x-show="dispute" class="form-group">
                    <label> Notes<span class="text-danger">*</span></label>
                    <textarea name="notes" id="" cols="3" rows="5" style="width: 100%"></textarea>
                </div>
                <p x-show="!dispute" class="my-3" style="color:#1A6571;font-weight:600">No Dispute.</p>
            </div>
        </div>
        <div class="d-flex flex-column " x-data="{ plots: 1}">
            <label class="my-2" style="font-weight: 600"> Plots List<span class="text-danger">*</span></label>
            <div class="flex align-items-center">
                <button type="button" x-on:click="plots += 1" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </button>
                <button x-show="plots !== 1" type="button" x-on:click="plots -= 1" class="btn btn-sm btn-danger">
                    <i class="ti ti-trash"></i>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Area</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                        $count = 1;
                    @endphp --}}
                        <template x-for="(index,plot) in plots">
                            <tr x-data="{total:0,area:0,price:0}">
                                <td x-text="index">
                                </td>
                                <td>
                                    <input type="text" :name="`plots[${index}][name]`" class="form-control" placeholder="Enter plot name">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][area]`" x-on:input="area = $event.target.value" class="form-control" placeholder="Enter plot area">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][price]`" x-on:input="price = $event.target.value" class="form-control" placeholder="Enter plot price">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][total_amount]`" x-bind:value="area * price" class="form-control" placeholder="Enter plot amount">
                                </td>
                                <td >
                                    <select :name="`plots[${index}][status]`" id="" class="form-control" style="width: 100%">
                                        <option value=""> Select Status</option>
                                        <option value="0">Vacant</option>
                                        <option value="1">Hold</option>
                                        <option value="2">Booked</option>
                                    </select>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="submit-section">
            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
        </div>
    </form>



    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
