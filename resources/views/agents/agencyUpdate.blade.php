{{Form::open(array('url'=>['agency',$agency->id],'method'=>'put'))}}
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                {{Form::text('name',$agency->name,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('phone',__('Phone'),['class'=>'form-label'])}}
                {{Form::tel('phone',$agency->phone,array('class'=>'form-control','placeholder'=>__('Enter Phone No.'),'required'=>'required'))}}
                @error('phone')
                <small class="invalid-phone" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('email',__('Email'),['class'=>'form-label'])}}
                {{Form::email('email',$agency->email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                @error('email')
                <small class="invalid-email" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('address',__('Address'),['class'=>'form-label']) }}
                {{Form::textarea('address',$agency->address,array('class'=>'form-control','placeholder'=>__('Enter agency address'),'required'=>'required','rows'=>'4'))}}
                @error('address')
                <small class="invalid-address" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>

{{Form::close()}}
