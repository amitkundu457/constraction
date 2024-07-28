{{ Form::open(['url' => 'product-unit']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('name', __('Unit Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
            @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
            @enderror
        </div>
        <div class="form-group col-md-12">
            <label>Unit Code <span class="text-danger">*</span></label>
            <input type="text" name="unit_code" id="edit_checkin" class="form-control">
        </div>
        <div class="form-group col-md-12">
            <label>Sort Order <span class="text-danger">*</span></label>
            <input type="number" name="sort_order" id="edit_checkin" class="form-control">
            
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
