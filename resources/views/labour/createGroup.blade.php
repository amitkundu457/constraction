{{ Form::open(['route' => 'labour-group.store', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
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
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('location', __('Location'), ['class' => 'form-label']) }} <span
                    class="text-danger">*</span>
                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => __('Enter Location'), 'required' => 'required']) }}
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('parent_id', __('Parent Group'), ['class' => 'form-label']) }} <span
                    class="text-danger">*</span>
                <select name="parent_id" id="" class="form-control">
                    <option value="">-- Select Group --</option>
                    @foreach ($grps as $grp)
                        <option value="{{ $grp->id }}">{{ $grp->name }}</option>
                    @endforeach
                </select>
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
