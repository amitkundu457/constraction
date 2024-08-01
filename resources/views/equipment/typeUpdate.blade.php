{{ Form::open(['url' => ['equipment/manufacturer',$type->id],'method'=>'put']) }}
<div class="modal-body">

    <div class="form-group ">
        {{ Form::label('name', __('Equipment Type Name'), ['class' => 'form-label']) }}
        {{ Form::text('name', $type->name, ['class' => 'form-control', 'required' => 'required']) }}
        @error('name')
            <small class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </small>
        @enderror
    </div>

</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
