{{ Form::open(['route' => ['labour-group.update',$grp->id], 'method' => 'put']) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('name', $grp->name, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required']) }}
                @error('name')
                    <small class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('location', __('Location'), ['class' => 'form-label']) }} <span class="text-danger">*</span>
                {{ Form::text('location', $grp->location, ['class' => 'form-control', 'placeholder' => __('Enter Location'), 'required' => 'required']) }}
                @error('location')
                    <small class="invalid-location" role="alert">
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
                    @foreach ($grps as $itm)
                        <option value="{{ $itm->id }}" @selected($grp->parent_group_id == $itm->id)>{{ $itm->name }}</option>
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
    <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
