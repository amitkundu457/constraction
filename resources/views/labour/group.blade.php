@extends('layouts.admin')
@php
    // $profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{ __('Manage Labour Group') }}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Labour Group') }}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        {{-- @if (\Auth::user()->type == 'company' || \Auth::user()->type == 'HR')
            <a href="{{ route('user.userlog') }}" class="btn btn-primary btn-sm {{ Request::segment(1) == 'user' }}"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('User Logs History') }}"><i class="ti ti-user-check"></i>
            </a>
        @endif --}}
        @can('create user')
            <a href="#" data-url="{{ route('labour-group.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip"
                title="{{ __('Create Labour Group') }}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        {{-- <th>Parent Group</th> --}}
                        <th>TimeStamp</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($grps as $grp)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $grp->name }}</td>
                            <td>{{ $grp->location }}</td>
                            {{-- <td>{{ __('dd') }}</td> --}}
                            <td>{{ Carbon\Carbon::parse($grp->created_at)->format('d M, Y h:i A') }}</td>
                            <td>
                                <div class="" style="display: flex">
                                    <a href="#" data-url="{{ route('labour-group.edit', $grp->id) }}"
                                        data-ajax-popup="true" data-bs-toggle="tooltip" title="{{ __('Update') }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['labour-group.destroy', $grp->id],
                                        'id' => 'delete-form-' . $grp->id,
                                    ]) !!}
                                    <a href="#" class="mx-1 btn btn-sm bg-danger align-items-center bs-pass-para"
                                        data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $grp->id }}').submit();">
                                        <i class="ti ti-trash text-white"></i>
                                    </a>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection
