{{ Form::open(['route' => 'plot.owner.store', 'method' => 'post','enctype'=>'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
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
                {{ Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone'), 'required' => 'required']) }}
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
                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => __('Enter City'), 'required' => 'required']) }}
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
                {{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('Enter State'), 'required' => 'required']) }}
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
                {{ Form::text('adhaar', null, ['class' => 'form-control', 'placeholder' => __('Enter Adhaar No'), 'required' => 'required']) }}
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
                {{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => __('Enter owner address'), 'required' => 'required', 'rows' => '2']) }}
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class=" row" x-data="{ files: 1 }">
                <label class="my-2" style="font-weight: 600"> Upload Documents <span
                        class="text-danger">*</span></label>
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
                            <template x-for="(index,file) in files">
                                <tr>
                                    <td x-text="index"></td>
                                    <td>
                                        <input type="text" :name="`documents[${index}][name]`" class="form-control"
                                            placeholder="Enter document name">
                                    </td>
                                    <td>
                                        <select :name="`documents[${index}][type]`" id="" class="form-control"
                                            style="width: 100%">
                                            <option value=""> Select Type</option>
                                            <option value="image">Image</option>
                                            <option value="document">Document</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="file" :name="`documents[${index}][file]`" class="form-control">
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- @if (\Auth::user()->type != 'super admin')
            <div class="form-group col-md-6">
                {{ Form::label('role', __('User Role'),['class'=>'form-label']) }}
                {!! Form::select('role', $roles, null,array('class' => 'form-control select','required'=>'required')) !!}
                @error('role')
                <small class="invalid-role" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        @elseif(\Auth::user()->type == 'super admin')
            {!! Form::hidden('role', 'company', null,array('class' => 'form-control select2','required'=>'required')) !!}
        @endif
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('password',__('Password'),['class'=>'form-label'])}}
                {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))}}
                @error('password')
                <small class="invalid-password" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        @if (!$customFields->isEmpty())
            <div class="col-md-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif --}}
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
