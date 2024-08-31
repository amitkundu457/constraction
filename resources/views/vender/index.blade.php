@extends('layouts.admin')
@php
    $profile = asset(Storage::url('uploads/avatar/'));

@endphp
@push('script-page')
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@section('page-title')
    {{ __('Manage Site') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('site') }}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" data-url="{{ route('vender.file.import') }}" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="{{ __('Import') }}">
            <i class="ti ti-file-import"></i>
        </a>

        <a href="{{ route('vender.export') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
            title="{{ __('Export') }}">
            <i class="ti ti-file-export"></i>
        </a>
        @can('create vender')
            <a href="#" data-size="lg" data-url="{{ route('vender.create') }}" data-ajax-popup="true"
                data-title="{{ __('Create New Site') }}" data-bs-toggle="tooltip" title="{{ __('Create') }}"
                class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan

    </div>
@endsection
@section('content')
    <div class="row" x-data="locationData()" x-init="init()">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>{{ __('  Site Name') }}</th>
                                    <th>{{ __(' Location ') }}</th>
                                    <th>{{ __('Contact') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    {{-- <th>{{ __('Budget') }}</th> --}}
                                    {{-- <th>{{ __('Start Date') }}</th> --}}
                                    {{-- <th>{{ __('End Date') }}</th> --}}
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($venders as $k => $Vender)
                                    <tr class="cust_tr" id="vend_detail">
                                        {{-- <td class="Id">
                                            @can('show vender')
                                                <a href="{{ route('vender.show', \Crypt::encrypt($Vender['id'])) }}"
                                                    class="btn btn-outline-primary">
                                                    {{ AUth::user()->venderNumberFormat($Vender['vender_id']) }}
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-outline-primary">
                                                    {{ AUth::user()->venderNumberFormat($Vender['vender_id']) }}
                                                </a>
                                            @endcan
                                        </td> --}}
                                        <td>{{ $Vender['site_name'] }}</td>
                                        <td>{{ $Vender['name'] }}</td>
                                        {{-- <td>{{ $Vender['cname'] }}</td> --}}
                                        <td>{{ $Vender['contact'] }}</td>
                                        <td>{{ $Vender['email'] }}</td>
                                        {{-- <td>{{ $Vender['value'] }}</td> --}}
                                        {{-- <td>{{ $Vender['start_date'] }}</td> --}}
                                        {{-- <td>{{ $Vender['end_date'] }}</td> --}}
                                        {{-- <td>{{ \Auth::user()->priceFormat($Vender['balance']) }}</td> --}}
                                        <td class="Action">
                                            <span>
                                                @if ($Vender['is_active'] == 0)
                                                    <i class="fa fa-lock" title="Inactive"></i>
                                                @else
                                                    @can('show vender')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="{{ route('vender.show', \Crypt::encrypt($Vender['id'])) }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="{{ __('View') }}">
                                                                <i class="text-white ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('edit vender')
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="#" class="mx-3 btn btn-sm align-items-center"
                                                                data-size="lg" data-title="{{ __('Edit Vendor') }}"
                                                                data-url="{{ route('vender.edit', $Vender['id']) }}"
                                                                data-ajax-popup="true" title="{{ __('Edit') }}"
                                                                data-bs-toggle="tooltip"
                                                                data-original-title="{{ __('Edit') }}">
                                                                <i class="text-white ti ti-pencil"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('delete vender')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['vender.destroy', $Vender['id']],
                                                                'id' => 'delete-form-' . $Vender['id'],
                                                            ]) !!}
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip"
                                                                data-original-title="{{ __('Delete') }}"
                                                                title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $Vender['id'] }}').submit();">
                                                                <i class="text-white ti ti-trash"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function clientDetails() {
            return {
                client: null,
                fetchClientDetails(id) {
                    if (!id) {
                        this.client = null;
                        return;
                    }

                    fetch(`/clients/${id}/details`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                this.client = data;
                                console.log(data);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching client details:', error);
                        });
                }
            }
        }
    </script>

    <script>
        function locationData() {
            return {
                countries: [],
                states: [],
                cities: [],
                selectedCountry: '',
                selectedState: '',
                selectedCity: '',
                loadCountries() {
                    fetch('https://countryapi.io/api/all?apikey=wUuauebYtpQHoY91c6Ncw6T1Jv9BW6ZyqU3iwUQo')
                        .then(response => response.json())
                        .then(data => {
                            console.log('API Response:', data); // Check the API response
                            this.countries = data
                            if (Array.isArray(data)) {
                                // this.countries = data.map(country => ({
                                //     code: country.alpha2Code || country.iso2 || country.code,
                                //     name: country.name
                                // }));
                            } else {
                                console.error('Unexpected data format:', data);
                            }
                        })
                        .catch(error => console.error('Error fetching countries:', error));
                },

                loadStates() {
                    fetch(`https://api.example.com/states?country=${this.selectedCountry}`)
                        .then(response => response.json())
                        .then(data => {
                            this.states = data.states;
                            this.cities = [];
                            this.selectedState = '';
                            this.selectedCity = '';
                        });
                },
                loadCities() {
                    fetch(`https://api.example.com/cities?state=${this.selectedState}`)
                        .then(response => response.json())
                        .then(data => {
                            this.cities = data.cities;
                            this.selectedCity = '';
                        });
                },
                init() {
                    this.loadCountries();
                }
            }
        }
    </script>
@endsection
