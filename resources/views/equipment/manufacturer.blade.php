@extends('layouts.admin')
@section('page-title')
    {{__('Manage Equipment Manufacturer')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('equipments.index')}}">{{__('Equipment')}}</a></li>
    <li class="breadcrumb-item">{{__('Manufacturer')}}</li>
    
@endsection
@section('action-btn')
    <div class="float-end">
        @can('create constant tax')
            <button type="button" data-url="{{ route('equipment.manufacturer.create') }}" data-ajax-popup="true" data-title="{{__('Create Equipment Manufacturer')}}" data-bs-toggle="tooltip" title="{{__('Create')}}"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </button>
        @endcan
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-3">
            @include('layouts.equipment_setup')
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> {{__('#')}}</th>
                                <th> {{__('Name')}}</th>
                                <th width="10%"> {{__('Action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i=0;
                                @endphp
                            @foreach ($types as $type)
                                <tr class="font-style">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $type->name }}</td>

                                    <td class="Action">
                                        <span>
                                        @can('edit constant tax')
                                                <div class="action-btn bg-primary ms-2">
                                                    <button type="button" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('equipment.manufacturer.edit',$type->id) }}" data-ajax-popup="true" data-title="{{__('Edit Equipment Manufacturer')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </button>
                                                </div>
                                            @endcan
                                            @can('delete constant tax')
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['equipment.manufacturer.destroy', $type->id],'id'=>'delete-form-'.$type->id]) !!}
                                                        <button type="button" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{--$taxe->id--}}').submit();">
                                                <i class="ti ti-trash text-white"></i>
                                            </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            @endcan
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
@endsection
