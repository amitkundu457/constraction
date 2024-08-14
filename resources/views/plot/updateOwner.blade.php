{{ Form::open(['route' => ['plot.owner.update',$owner->id], 'method' => 'put','enctype'=>'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('name', $owner->name, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::tel('phone', $owner->name, ['class' => 'form-control', 'placeholder' => __('Enter Phone'), 'required' => 'required']) }}
                @error('phone')
                    <small class="invalid-phone" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('location', __('City'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('location', $owner->location, ['class' => 'form-control', 'placeholder' => __('Enter City'), 'required' => 'required']) }}
                @error('location')
                    <small class="invalid-location" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('state', __('State'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('state', $owner->state, ['class' => 'form-control', 'placeholder' => __('Enter State'), 'required' => 'required']) }}
                @error('state')
                    <small class="invalid-state" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('adhaar', __('Adhaar No'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('adhaar', $owner->adhaar, ['class' => 'form-control', 'placeholder' => __('Enter Adhaar No'), 'required' => 'required']) }}
                @error('adhaar')
                    <small class="invalid-adhaar" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('address', __('Address'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::textarea('address', $owner->address, ['class' => 'form-control', 'placeholder' => __('Enter owner address'), 'required' => 'required', 'rows' => '2']) }}
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class=" row" x-data="{ files: {{ count($owner->documents) }}, docs: {{ json_encode($owner->documents) }} }">
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
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
