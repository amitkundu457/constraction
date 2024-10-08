@extends('layouts.admin')
@php
   // $profile=asset(Storage::url('uploads/avatar/'));
    $profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Manage Drivers')}}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Driver')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @if (\Auth::user()->type == 'company' || \Auth::user()->type == 'HR')
            <a href="{{ route('user.userlog') }}" class="btn btn-primary btn-sm {{ Request::segment(1) == 'user' }}"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('User Logs History') }}"><i class="ti ti-user-check"></i>
            </a>
        @endif
        @can('create user')
            <a href="#" data-size="lg" data-url="{{ route('drivers.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                @foreach($drivers as $driver)
                    <div class="col-md-3 mb-4">
                        <div class="card text-center card-2">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <div class="badge bg-primary p-2 px-3 rounded">
                                            {{-- {{ ucfirst($user->type) }} --}}
                                            {{__('Driver')}}
                                        </div>
                                    </h6>
                                </div>
                                {{-- @if(Gate::check('edit user') || Gate::check('delete user')) --}}
                                    <div class="card-header-right">
                                        <div class="btn-group card-option">
                                            {{-- @if($user->is_active == 1) --}}
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end">

                                                    {{-- @can('edit user') --}}
                                                        <a href="#" data-size="lg" data-url="{{ route('drivers.edit',$driver->id) }}" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="{{__('Edit Driver')}}">
                                                            <i class="ti ti-pencil"></i>
                                                            <span>{{__('Edit')}}</span>
                                                        </a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('delete user') --}}
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $driver['id']],'id'=>'delete-form-'.$driver['id']]) !!}
                                                        <a href="#!"  class="dropdown-item bs-pass-para">
                                                            <i class="ti ti-archive"></i>
                                                            {{-- <span> @if($user->delete_status!=0){{__('Delete')}} @else {{__('Restore')}}@endif</span> --}}
                                                        </a>
                                                        {!! Form::close() !!}
                                                    {{-- @endcan --}}

                                                    <a href="#!" data-url="{{--route('users.reset',\Crypt::encrypt($agent->id))--}}" data-ajax-popup="true" data-size="md" class="dropdown-item" data-bs-original-title="{{__('Reset Password')}}">
                                                        <i class="ti ti-adjustments"></i>
                                                        <span>  {{__('Reset Password')}}</span>
                                                    </a>
                                                </div>
                                            {{-- @else
                                                <a href="#" class="action-item text-lg"><i class="ti ti-lock"></i></a>
                                            @endif --}}

                                        </div>
                                    </div>
                                {{-- @endif --}}
                            </div>

                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <img src="https://t4.ftcdn.net/jpg/03/59/58/91/360_F_359589186_JDLl8dIWoBNf1iqEkHxhUeeOulx0wOC5.jpg" class="img-user wid-80 round-img rounded-circle">
                                </div>
                                <h4 class=" mt-3 text-primary">{{ $driver->name }}</h4>
                                {{-- @if($user->delete_status==0)
                                    <h5 class="office-time mb-0">{{__('Soft Deleted')}}</h5>
                                @endif --}}
                                <small class="text-primary">{{ $driver->email }}</small>
                                <p></p>
                                <div class="text-center" data-bs-toggle="tooltip" title="{{__('Last Login')}}">
                                    {{-- {{ (!empty($user->last_login_at)) ? $user->last_login_at : '' }} --}}
                                </div>
                                {{-- @if(\Auth::user()->type == 'super admin')
                                    <div class="mt-4">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-6 text-center">
                                                <span class="d-block font-bold mb-0">{{!empty($user->currentPlan)?$user->currentPlan->name:''}}</span>
                                            </div>
                                            <div class="col-6 text-center Id ">
                                                <a href="#" data-url="{{ route('plan.upgrade',$user->id) }}" data-size="lg" data-ajax-popup="true" class="btn btn-outline-primary"
                                                   data-title="{{__('Upgrade Plan')}}">{{__('Upgrade Plan')}}</a>
                                            </div>
                                            <div class="col-12">
                                                <hr class="my-3">
                                            </div>
                                            <div class="col-12 text-center pb-2">
                                                <span class="text-dark text-xs">{{__('Plan Expired : ') }} {{!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date): __('Lifetime')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12">
                                            <div class="card mb-0">
                                                <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p class="text-muted text-sm mb-0" data-bs-toggle="tooltip" title="{{__('Users')}}"><i class="ti ti-users card-icon-text-space"></i>{{$user->totalCompanyUser($user->id)}}</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted text-sm mb-0" data-bs-toggle="tooltip" title="{{__('Customers')}}"><i class="ti ti-users card-icon-text-space"></i>{{$user->totalCompanyCustomer($user->id)}}</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <p class="text-muted text-sm mb-0" data-bs-toggle="tooltip" title="{{__('Vendors')}}"><i class="ti ti-users card-icon-text-space"></i>{{$user->totalCompanyVender($user->id)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
