{{Form::open(array('url'=>['drivers',$driver->id],'method'=>'put'))}}
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                {{Form::text('name',$driver->name,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('contact',__('Contact'),['class'=>'form-label'])}}
                {{Form::tel('contact',$driver->contact,array('class'=>'form-control','placeholder'=>__('Enter Contact'),'required'=>'required'))}}
                @error('contact')
                <small class="invalid-contact" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('email',__('Email'),['class'=>'form-label'])}}
                {{Form::email('email',$driver->email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
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
                {{Form::textarea('address',$driver->address,array('class'=>'form-control','placeholder'=>__('Enter driver address'),'required'=>'required'))}}
                @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('city',__('City'),['class'=>'form-label']) }}
                {{Form::text('city',$driver->city,array('class'=>'form-control','placeholder'=>__('Enter City'),'required'=>'required'))}}
                @error('city')
                <small class="invalid-city" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('state',__('State'),['class'=>'form-label']) }}
                {{Form::text('state',$driver->state,array('class'=>'form-control','placeholder'=>__('Enter State'),'required'=>'required'))}}
                @error('state')
                <small class="invalid-state" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('pincode',__('Pincode'),['class'=>'form-label']) }}
                {{Form::number('pincode',$driver->pincode,array('class'=>'form-control','placeholder'=>__('Enter Pincode'),'required'=>'required'))}}
                @error('pincode')
                <small class="invalid-pincode" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        {{-- @if(\Auth::user()->type != 'super admin')
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
        @if(!$customFields->isEmpty())
            <div class="col-md-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif --}}
    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{Form::close()}}
