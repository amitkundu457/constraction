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
    <form action="{{ route('plot.edit', $plot->id) }}" class="mt-3" method="post" x-data="{ owner: null, getOwner(id) { fetch(`/plot/owner/${id}`).then((res) => res.json()).then((data) => this.owner = data.owner) } }"
        enctype="multipart/form-data">
        @csrf
        <div class=" row">
            <div class="form-group col-md-4" x-init="getOwner({{ $plot->owner_id }})">
                <label>Owner Name <span class="text-danger">*</span></label>
                <select name="owner_id" x-on:change="getOwner($event.target.value)" id="" class="form-control">
                    <option value="">--- Select Owner ---</option>
                    @foreach ($owners as $own)
                        <option value="{{ $own->id }}" @selected($plot->owner_id == $own->id)>{{ $own->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Owner Phone no <span class="text-danger">*</span></label>
                <input type="tel" name="phone_no" :value="owner && owner.phone" id="edit_checkin" class="form-control"
                    value="">
            </div>
            <div class="form-group col-md-4">
                <label>Owner Adhaar No. <span class="text-danger">*</span></label>
                <input type="tel" name="" :value="owner && owner.adhaar" id="edit_checkin" class="form-control">
            </div>
        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label> Project <span class="text-danger">*</span></label>
                <select name="project_id" id="" class="form-control">
                    <option value="">--- Select Project ---</option>
                    @foreach ($projects as $proj)
                        <option value="{{ $proj->id }}" @selected($plot->project_id == $proj->id)>{{ $proj->project_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Area <span class="text-danger">*</span></label>
                <input type="number" name="block_name" id="edit_checkin" class="form-control"
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
        <div class="form-group">
            <label> Address <span class="text-danger">*</span></label>
            <textarea name="address" id="" cols="" rows="5" class="form-control">{{ $plot->address }}</textarea>
        </div>
        <div class=" row">
            <div class="form-group col-md-6">
                <label>Plot Price <span class="text-danger">*</span></label>
                <input type="text" name="amount" id="edit_checkin" class="form-control" value="{{ $plot->amount }}">
            </div>
            <div class="form-group col-md-6">
                <label> Total Plots <span class="text-danger">*</span></label>
                <input type="number" min="0" name="total_plots" id="edit_checkin" class="form-control"
                    value="{{ $plot->total_plots }}">
            </div>
        </div>
        <template x-if="owner">
            <div class=" row" x-data="{ files: owner ? owner.documents.length : null, docs: owner ? owner.documents : null }">
                <label class="my-2" style="font-weight: 600"> Owner Documents<span class="text-danger">*</span></label>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>

                            <template x-for="(file,index) in owner.documents" x-init="console.log(owner.documents)">
                                <tr>
                                    <td x-text="index +1"></td>
                                    <td>
                                        <p x-text="file.name"></p>
                                    </td>
                                    <td x-text="file.type">

                                    </td>
                                    <td>
                                        <template x-if="owner.documents[index].type == 'document'">
                                            <a :href="'/plot/' + owner.documents[index].file" class="btn btn-sm btn-danger"
                                                :download="owner.documents[index].file" style="font-size:15px;"><i class="ti ti-download"></i></a>
                                        </template>
                                        <template x-if="owner.documents[index].type == 'image'">
                                            <img :src="'/plot/' + owner.documents[index].file" width="120px">
                                        </template>

                                    </td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
                </div>
            </div>
        </template>
        <div class=" row" x-data="{ files: {{ count($plot->documents) }}, docs: {{ json_encode($plot->documents) }} }">
            <label class="my-2" style="font-weight: 600"> Upload Documents<span class="text-danger">*</span></label>
            <div class="flex align-items-center">
                <button type="button" x-on:click="files += 1" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </button>
                <button x-cloak x-show="files !== 1" type="button" x-on:click="files -= 1"
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
                            <th>Type</th>
                            <th>Upload</th>
                            <th>Preview</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                    <input type="hidden" :name="`documents[${index}][file_old]`"
                                        :value="docs[index - 1].file">
                                </td>
                                <td>
                                    <template x-if="docs[index - 1].type == 'document'">
                                        <a :href="'/plot/' + docs[index - 1].file" class="btn btn-sm btn-danger" :download="docs[index - 1].file"
                                            style="font-size:15px;"><i class="ti ti-download"></i></a>
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
        </div>
        <div class="row" x-data="{ dispute: {{ isset($plot->notes) ?? 'false' }} }">
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
                    <textarea name="notes" id="" class="form-control" cols="3" rows="5" style="width: 100%">{{ $plot->notes }}</textarea>
                </div>
                <p x-show="!dispute" class="my-3" style="color:#1A6571;font-weight:600">No Dispute.</p>
            </div>
        </div>
        <div class="d-flex flex-column " x-data="{ plots: {{ count($plot->plot_list) }}, plotData: {{ json_encode($plot->plot_list) }} }">
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
                            <th>Location</th>
                            <th>Area</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(index,plot) in plots">
                            <tr x-data="{ total: plotData[index].total_amount, area: plotData[index].area, price: plotData[index].price }">
                                <td x-text="index">
                                </td>
                                <td>
                                    <input type="text" :name="`plots[${index}][name]`" :value="plotData[index].name"
                                        class="form-control" placeholder="Enter plot name">
                                </td>
                                <td>
                                    <input type="text" :name="`plots[${index}][location]`"
                                        :value="plotData[index].location" class="form-control"
                                        placeholder="Enter plot location">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][area]`" :value="area"
                                        x-on:input="area = $event.target.value" class="form-control"
                                        placeholder="Enter plot area">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][price]`" :value="price"
                                        x-on:input="price = $event.target.value" class="form-control"
                                        placeholder="Enter plot price">
                                </td>
                                <td>
                                    <input type="number" :name="`plots[${index}][total_amount]`" :value="area * price"
                                        class="form-control" placeholder="Enter plot amount">
                                </td>
                                <td>
                                    <select :name="`plots[${index}][status]`" id="" class="form-control"
                                        style="width: 100%">
                                        <option value=""> Select Status</option>
                                        <option value="0" :selected="plotData[index].status == '0'">Vacant</option>
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
