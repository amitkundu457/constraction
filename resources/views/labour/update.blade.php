{{ Form::open(['route' => ['labour.update',$lb->id], 'method' => 'put']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('labour_group_id', __('Group'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                <select name="labour_group_id" id="" class="form-control" required>
                    <option value="">-- Select Group --</option>
                    @foreach ($grps as $g)
                        <option value="{{ $g->id }}" @selected($lb->labour_group_id == $g->id)>{{ $g->name }}</option>
                    @endforeach
                </select>
                @error('labour_group_id')
                    <small class="invalid-labour_group_id" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('name', $lb->name, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::tel('phone', $lb->phone, ['class' => 'form-control', 'placeholder' => __('Enter Phone'), 'required' => 'required']) }}
                @error('phone')
                    <small class="invalid-phone" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('adhaar', __('Adhaar No.'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::number('adhaar', $lb->adhaar, ['class' => 'form-control', 'placeholder' => __('Enter Adhaar No.'), 'required' => 'required']) }}
                @error('adhaar')
                    <small class="invalid-adhaar" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('price', __('Rate'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::number('price', $lb->price, ['class' => 'form-control', 'placeholder' => __('Enter Rate'), 'required' => 'required']) }}
                @error('price')
                    <small class="invalid-price" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('documents', __('Document'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                <input type="file" name="documents" id="" class="form-control" required="required">
                @error('documents')
                    <small class="invalid-documents" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div> --}}
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
