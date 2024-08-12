{{Form::open(array('url'=>['agents',$agent->id],'method'=>'put'))}}
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                {{Form::text('name',$agent->name,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
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
                {{Form::tel('contact',$agent->contact,array('class'=>'form-control','placeholder'=>__('Enter Contact'),'required'=>'required'))}}
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
                {{Form::email('email',$agent->email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                @error('email')
                <small class="invalid-email" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('dob',__('DOB'),['class'=>'form-label'])}}
                {{Form::date('dob',$agent->dob,array('class'=>'form-control','placeholder'=>__('Enter DOB'),'required'=>'required'))}}
                @error('dob')
                <small class="invalid-dob" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('pan',__('PAN NO.'),['class'=>'form-label']) }}
                {{Form::text('pan',$agent->pan,array('class'=>'form-control','placeholder'=>__('Enter Pan No'),'required'=>'required'))}}
                @error('pan')
                <small class="invalid-pan" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('deals_in',__('Agency Name'),['class'=>'form-label']) }}
                {{Form::text('deals_in',null,array('class'=>'form-control','placeholder'=>__('Agency Name'),'required'=>'required'))}}
                @error('deals_in')
                <small class="invalid-deals_in" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('document',__('Document'),['class'=>'form-label']) }}
                <input type="file" class="form-control" name="document">
                @error('document')
                <small class="invalid-document" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('city',__('City'),['class'=>'form-label']) }}
                {{Form::text('city',null,array('class'=>'form-control','placeholder'=>__('Enter City'),'required'=>'required'))}}
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
                {{Form::text('state',null,array('class'=>'form-control','placeholder'=>__('Enter State'),'required'=>'required'))}}
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
                {{Form::number('pincode',null,array('class'=>'form-control','placeholder'=>__('Enter Pincode'),'required'=>'required'))}}
                @error('pincode')
                <small class="invalid-pincode" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('address',__('Address'),['class'=>'form-label']) }}
                {{Form::textarea('address',null,array('class'=>'form-control','placeholder'=>__('Enter agent address'),'required'=>'required','rows'=>'4'))}}
                @error('name')
                <small class="invalid-name" role="alert">
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
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>

{{Form::close()}}
