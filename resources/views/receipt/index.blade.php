@push('css-page')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"
        integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@extends('layouts.admin')
@section('page-title')
    {{ __('Receipt') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Receipt') }}</li>
@endsection


@section('action-btn')
    <div class="float-end">
        @can('create purchase')
            <a href="{{ route('receipt.create') }}" data-title="{{ __('Create Receipt') }}" data-bs-toggle="tooltip"
                title="{{ __('Create') }}" class="btn btn-sm btn-primary" title="{{ __('Create') }}">
                <i class="ti ti-plus"></i>
            </a>
        @endcan
    </div>
@endsection


@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th> {{ __('Receipt No') }}</th>
                                    <th> {{ __('Project') }}</th>
                                    <th> {{ __('Site') }}</th>
                                    <th> {{ __('Supplier') }}</th>
                                    <th> {{ __('Amount') }}</th>
                                    <th>{{ __('Timestamp') }}</th>
                                    <th> {{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rcs as $r)
                                    <tr>
                                        <td>{{ $r->number }}</td>
                                        <td>{{ $r->project->project_name }}</td>
                                        <td>{{ $r->vender->name }}</td>
                                        <td>{{ $r->company->name }}</td>
                                        <td>{{ array_sum(array_column($r->materials, 'price')) }}</td>
                                        <td>{{ Auth::user()->dateformat($r->date) }}</td>
                                        <td>
                                            <div class="" style="display: flex">
                                                <a href="{{ route('receipt.edit', $r->id) }}"
                                                    class="btn btn-sm btn-primary bg-primary"><i class="fas fa-pen"></i></a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['receipt.destroy', $r->id],
                                                    'id' => 'delete-form-' . $r->id,
                                                ]) !!}
                                                <a href="#"
                                                    class="mx-1 btn btn-sm bg-danger align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                    data-original-title="{{ __('Delete') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-form-{{ $r->id }}').submit();">
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
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
        integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
