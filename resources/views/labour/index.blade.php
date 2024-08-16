@extends('layouts.admin')
@php
    // $profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{ __('Manage Labours') }}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Labour') }}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        @can('create user')
            <a href="#" data-size="lg" data-url="{{ route('labour.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip"
                title="{{ __('Create Labour') }}" class="btn btn-sm btn-primary">
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
                        <th>Group</th>
                        <th>Rate</th>
                        <th>TimeStamp</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($labours as $lb)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $lb->name }}</td>
                            <td>{{ $lb->group->name }}</td>
                            <td>{{ $lb->price }}</td>
                            <td>{{ Carbon\Carbon::parse($lb->created_at)->format('d M, Y h:i A') }}</td>
                            <td>
                                <div class="" style="display: flex">
                                    <a href="#" data-size="lg" data-url="{{ route('labour.edit', $lb->id) }}"
                                        data-ajax-popup="true" data-bs-toggle="tooltip" title="{{ __('Update') }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['labour.destroy', $lb->id],
                                        'id' => 'delete-form-' . $lb->id,
                                    ]) !!}
                                    <a href="#" class="mx-1 btn btn-sm bg-danger align-items-center bs-pass-para"
                                        data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $lb->id }}').submit();">
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
