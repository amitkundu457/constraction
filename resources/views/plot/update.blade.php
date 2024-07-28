@extends('layouts.admin')

@section('page-title')
    {{ __('Update Plot') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plot.index') }}">{{ __('Plot') }}</a></li>
    <li class="breadcrumb-item">{{ __('Update') }}</li>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js"></script>
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <form action="{{ route('plot.edit',$plot->id) }}" class="mt-3" method="post" enctype="multipart/form-data">
        @csrf
        <div class=" row">
            <div class="form-group col-md-6">
                <label>Owner Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="edit_checkin" class="form-control" value="{{ $plot->name }}">
            </div>
            <div class="form-group col-md-6">
                <label> Phone no <span class="text-danger">*</span></label>
                <input type="tel" name="phone_no" id="edit_checkin" class="form-control" value="{{ $plot->phone_no }}">
            </div>

        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Project name <span class="text-danger">*</span></label>
                <input type="text" name="project_name" id="edit_checkin" class="form-control"
                    value="{{ $plot->project_name }}">
            </div>
            <div class="form-group col-md-6">
                <label> Block name <span class="text-danger">*</span></label>
                <input type="text" name="block_name" id="edit_checkin" class="form-control"
                    value="{{ $plot->block_name }}">
            </div>

        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Khasra No. <span class="text-danger">*</span></label>
                <input type="text" name="khasra_no" id="edit_checkin" class="form-control"
                    value="{{ $plot->khasra_no }}">
            </div>
            <div class="form-group col-md-6">
                <label> Mauza No <span class="text-danger">*</span></label>
                <input type="text" name="mauza_no" id="edit_checkin" class="form-control" value="{{ $plot->mauza_no }}">
            </div>

        </div>
        {{-- <input type="hidden" name="id" id="edit_id"> --}}


        <div class="form-group">
            <label> Address <span class="text-danger">*</span></label>
            <textarea name="address" id="" cols="" rows="5" class="form-control">{{ $plot->address }}</textarea>
        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Amount <span class="text-danger">*</span></label>
                <input type="text" name="amount" id="edit_checkin" class="form-control" value="{{ $plot->amount }}">
            </div>
            <div class="form-group col-md-6">
                <label> Total Plots <span class="text-danger">*</span></label>
                <input type="number" min="0" name="total_plots" id="edit_checkin" class="form-control"
                    value="{{ $plot->total_plots }}">
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
        <div class=" row" x-data="{ files: {{ count($plot->documents) }}, docs: {{ json_encode($plot->documents) }} }">
            <label class="my-2" style="font-weight: 600"> Upload Documents<span class="text-danger">*</span></label>
            <div class="flex align-items-center">
                <button type="button" x-on:click="files += 1" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </button>
                <button x-cloak x-show="files !== 1" type="button" x-on:click="files -= 1" class="btn btn-sm btn-danger">
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
                            <th>Preview</th>
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
                                    <input type="text" :name="`documents[${index}][name]`" :value="docs[index - 1].name"
                                        class="form-control" placeholder="Enter document name">
                                </td>
                                <td>
                                    <select :name="`documents[${index}][type]`" id="" class="form-control"
                                        style="width: 100%">
                                        <option value=""> Select Type</option>
                                        <option value="image" :selected="docs[index - 1].type == 'image'">Image</option>
                                        <option value="document" :selected="docs[index - 1].type == 'document'">Document
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="file" :name="`documents[${index}][file]`" class="form-control">
                                    <input type="hidden"  :name="`documents[${index}][file_old]`" :value="docs[index - 1].file">
                                </td>
                                <td>
                                    <template x-if="docs[index - 1].type == 'document'">
                                        <a :href="'/plot/' + docs[index - 1].file"  :download="docs[index - 1].file" style="font-size:15px;" x-text="docs[index - 1].file"></a>
                                    </template>
                                    <template x-if="docs[index - 1].type == 'image'">
                                        <img :src="'/plot/' + docs[index - 1].file" width="120px">
                                    </template>

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


        <div class="row" x-data="{ dispute: {{ $plot->notes ?? 'false' }} }">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Has Any Dispute<span class="text-danger">*</span></label>
                    <div class="my-3">
                        <div class="form-check">
                            <input class="form-check-input" x-on:change="dispute = true" name="dispute" type="radio"
                                checked="dispute">
                            <label class="form-check-label" style="font-weight: 500">
                                Yes
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" x-on:change="dispute = false" name="dispute" type="radio"
                                checked="!dispute">
                            <label class="form-check-label" for="exampleRadios3" style="font-weight: 500">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div x-cloak x-show="dispute" class="form-group">
                    <label> Summary<span class="text-danger">*</span></label>
                    <textarea name="notes" id="" cols="3" rows="5" style="width: 100%"></textarea>
                </div>
                <p x-show="!dispute" class="my-3" style="color:#1A6571;font-weight:600">No Dispute.</p>
            </div>
        </div>
        <div class="d-flex flex-column " x-data="{ plots: {{ count($plot->plot_list) }},plotData:{{ json_encode($plot->plot_list) }} }">
            <label class="my-2" style="font-weight: 600"> Plots List<span class="text-danger">*</span></label>
            <div class="flex align-items-center">
                <button type="button" x-on:click="plots += 1" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </button>
                <button x-cloak x-show="plots !== 1" type="button" x-on:click="plots -= 1"
                    class="btn btn-sm btn-danger">
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
                            <tr x-data="{ total: plotData[index].total_amount, area: plotData[index].area, price: plotData[index].price }">
                                <td x-text="index">
                                </td>
                                <td>
                                    <input type="text" :name="`plots[${index}][name]`" :value="plotData[index].name" class="form-control"
                                        placeholder="Enter plot name">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][area]`" :value="area" x-on:input="area = $event.target.value"
                                        class="form-control" placeholder="Enter plot area">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][price]`" :value="price" x-on:input="price = $event.target.value"
                                        class="form-control" placeholder="Enter plot price">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][total_amount]`"  :value="area * price"
                                        class="form-control" placeholder="Enter plot amount">
                                </td>
                                <td>
                                    <select :name="`plots[${index}][status]`" id="" class="form-control"
                                        style="width: 100%">
                                        <option value=""> Select Status</option>
                                        <option value="0"  :selected="plotData[index].status == '0'">Vacant</option>
                                        <option value="1" :selected="plotData[index].status == '1'">Hold</option>
                                        <option value="2" :selected="plotData[index].status == '2'">Booked</option>
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
