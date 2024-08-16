{{ Form::open(['url' => 'vender', 'method' => 'post']) }}
<div class="modal-body" x-data="clientDetails()">

    <h6 class="sub-title">{{ __('Basic Info') }}</h6>
    <div class="row">
        <div class="col-lg-6 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('Site name', __('Site name'), ['class' => 'form-label']) }}
                {{ Form::text('site_name', null, ['class' => 'form-control', 'required' => 'required']) }}

            </div>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('Location name', __('Location name'), ['class' => 'form-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="">Phone No</label>
                <input type="number" class="form-control" name="contact">

            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-4 col-sm-6">
            <label for="">Contractor </label>
            <select name="client_id" id="" class="form-control"
                @change="fetchClientDetails($event.target.value)">
                @php
                    $clients = App\Models\User::where('type', 'client')->get();

                @endphp
                <option value="">Select Client name</option>
                @foreach ($clients as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

        </div> --}}
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email">

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_zip', __('Zip Code'), ['class' => 'form-label']) }}
                {{ Form::text('billing_zip', null, ['class' => 'form-control']) }}

            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="">Start date</label>
                <input type="text" class="form-control" name="email" :value="client.start_date" readonly>

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="">End date</label>
                <input type="text" class="form-control" name="email" :value="client.end_date" readonly>

            </div>
        </div> --}}

        {{-- <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="">Budget</label>
                <input type="text" class="form-control" name="email" :value="client && client.value" readonly>

            </div>
        </div> --}}
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('billing_address', __('Address'), ['class' => 'form-label']) }}
                {{ Form::textarea('billing_address', null, ['class' => 'form-control', 'rows' => 3]) }}
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_city', __('City'), ['class' => 'form-label']) }}
                {{ Form::text('billing_city', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_state', __('State'), ['class' => 'form-label']) }}
                {{ Form::text('billing_state', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6" x-data="locationData()">
            <div class="form-group">
                <select x-model="selectedCountry" id="country" class="form-control">
                    <option value="">Select Country</option>
                    <template x-for="country in countries" :key="country.code">
                        <option :value="country.code" x-text="country.name"></option>
                    </template>
                </select>

            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('tax_number', __('Tax Number'), ['class' => 'form-label']) }}
                {{ Form::text('tax_number', null, ['class' => 'form-control']) }}

            </div>
        </div>
        @if (!$customFields->isEmpty())
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif
    </div>
    <h6 class="sub-title">{{ __('Billing Address') }}</h6>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_name', __('Name'), ['class' => 'form-label']) }}
                {{ Form::text('billing_name', null, ['class' => 'form-control']) }}

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_phone', __('Phone'), ['class' => 'form-label']) }}
                {{ Form::text('billing_phone', null, ['class' => 'form-control']) }}

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('billing_address', __('Address'), ['class' => 'form-label']) }}
                {{ Form::textarea('billing_address', null, ['class' => 'form-control', 'rows' => 3]) }}
            </div>
        </div>



        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_state', __('State'), ['class' => 'form-label']) }}
                {{ Form::text('billing_state', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_country', __('Country'), ['class' => 'form-label']) }}
                {{ Form::text('billing_country', null, ['class' => 'form-control']) }}

            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_zip', __('Zip Code'), ['class' => 'form-label']) }}
                {{ Form::text('billing_zip', null, ['class' => 'form-control']) }}

            </div>
        </div>

    </div>

    @if (App\Models\Utility::getValByName('shipping_display') == 'on')
        <div class="col-md-12 text-end">
            <input type="button" id="billing_data" value="{{ __('Shipping Same As Billing') }}"
                class="btn btn-primary">
        </div>
        <h6 class="sub-title">{{ __('Shipping Address') }}</h6>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_name', __('Name'), ['class' => 'form-label']) }}
                    {{ Form::text('shipping_name', null, ['class' => 'form-control']) }}

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_phone', __('Phone'), ['class' => 'form-label']) }}
                    {{ Form::text('shipping_phone', null, ['class' => 'form-control']) }}

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('shipping_address', __('Address'), ['class' => 'form-label']) }}
                    {{ Form::textarea('shipping_address', null, ['class' => 'form-control', 'rows' => 3]) }}
                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_city', __('City'), ['class' => 'form-label']) }}
                    {{ Form::text('shipping_city', null, ['class' => 'form-control']) }}

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_state', __('State'), ['class' => 'form-label']) }}
                    {{ Form::text('shipping_state', null, ['class' => 'form-control']) }}

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_country', __('Country'), ['class' => 'form-label']) }}
                    {{ Form::text('shipping_country', null, ['class' => 'form-control']) }}

                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_zip', __('Zip Code'), ['class' => 'form-label']) }}
                    {{ Form::text('shipping_zip', null, ['class' => 'form-control']) }}
                </div>
            </div>

        </div>
    @endif --}}

    </div>
    <div class="modal-footer">
        <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
    </div>
    {{ Form::close() }}
