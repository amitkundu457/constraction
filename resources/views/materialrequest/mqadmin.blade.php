@extends('layouts.admin')
@section('page-title')
    {{ __('Material Requirments') }}
@endsection
@push('script-page')
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">{{ __('Project') }}</a></li>
    {{-- <li class="breadcrumb-item"><a href="{{ route('projects.show', $project->id) }}">{{ ucwords($project->project_name) }}</a> --}}
    </li>
    <li class="breadcrumb-item">{{ __('Bug Report') }}</li>
@endsection
@section('action-btn')
    {{-- <div class="float-end">
        @can('manage bug report')
            <a href="{{ route('task.bug.kanban', $project->id) }}" data-bs-toggle="tooltip" title="{{ __('Kanban') }}"
                class="btn btn-sm btn-primary">
                <i class="ti ti-grid-dots"></i>
            </a>
        @endcan

    </div> --}}
    @can('create bug report')
        <a href="#" data-size="lg" data-bs-toggle="modal" data-bs-target="#exampleModal" title="{{ __('Create New Bug') }}"
            class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
    <div class="row">


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('materials-requirments') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="date" type="date"
                                    value="{{ Carbon\Carbon::now() }}" id="">
                            </div>
                            <div class="form-group">
                                @php
                                    $projects = App\Models\Project::all();
                                @endphp
                                <select name="project_id" id="" class="form-control">
                                    <option value="">Select Project</option>
                                    @foreach (App\Models\Project::all() as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="employee_id" id="" class="form-control">
                                    @foreach (App\Models\Employee::all() as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="material_id" id="" class="form-control">
                                    @foreach (App\Models\ProductService::all() as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Qty" name="qty">
                            </div>
                            <div class="form-group">
                                <textarea name="purpose" id="" cols="10" rows="5"></textarea>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card" style="padding: 2rem">
                <form method="GET" action="{{ url('material-requirment-search') }}" style="display: flex">
                    <div class="form-group" style="display: flex;width:50%;">
                        <input class="form-control" type="date" name="start_date" value="{{ request('start_date') }}">
                        <input class="form-control" type="date" name="end_date" value="{{ request('end_date') }}"
                            style="margin-left:1rem">
                    </div>
                    <button type="submit" class="btn btn-success" style="height: 41px ;margin-left:1rem">Filter</button>
                </form>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th> {{ __('Project Name') }}</th>
                                    <th> {{ __('Employee Name') }}</th>
                                    <th> {{ __('Materials') }}</th>
                                    <th> {{ __('purpose') }}</th>
                                    <th> {{ __('Qty') }}</th>
                                    <th> {{ __('Status') }}</th>
                                    {{-- <th> {{ __('Priority') }}</th> --}}
                                    {{-- <th> {{ __('Created By') }}</th> --}}
                                    <th width="10%"> {{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mq as $bug)
                                    <th>{{ $bug->project_name }}</th>
                                    <th>{{ $bug->name }}</th>
                                    <th>{{ $bug->pro_name }}</th>
                                    <th>{{ $bug->purpose }}</th>
                                    <th>{{ $bug->qty }}</th>
                                    <th>
                                        @if ($bug->status === 0)
                                            <a href="{{ url('material-requirment-status', $bug->id) }}"
                                                class="text-danger">Pending</a>
                                        @elseif($bug->status === 1)
                                            <a href="{{ url('material-requirment-pending', $bug->id) }}"
                                                class="text-success">Approved</a>
                                        @endif
                                    </th>
                                    <th>
                                        @if ($bug->status === 0)
                                        @elseif($bug->status === 1)
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="{{ route('project.bill', \Crypt::encrypt($bug->id)) }}"
                                                    class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                    title="{{ __('Generate') }}"
                                                    data-original-title="{{ __('Detail') }}">
                                                    <i class="text-white ti ti-file-invoice"></i>
                                                </a>
                                            </div>
                                        @endif

                                        <div class="action-btn bg-danger ms-2">
                                            <a href="#" data-url="{{ URL::to('leave/' . $bug->id . '/action') }}"
                                                data-size="lg" data-ajax-popup="true"
                                                data-title="{{ __('Leave Action') }}"
                                                class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                title="{{ __('Leave Action') }}"
                                                data-original-title="{{ __('Leave Action') }}">
                                                <i class="text-white ti ti-trash"></i> </a>
                                        </div>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" data-url="{{ URL::to('leave/' . $bug->id . '/edit') }}"
                                                data-size="lg" data-ajax-popup="true"
                                                data-title="{{ __('Edit Leave') }}"
                                                class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                title="{{ __('Edit') }}" data-original-title="{{ __('Edit') }}">
                                                <i class="text-white ti ti-pencil"></i></a>
                                        </div>
                                    </th>
                                @endforeach
                                {{-- @foreach ($bugs as $bug)
                                <tr>
                                    <td>{{ \Auth::user()->bugNumberFormat($bug->bug_id)}}</td>
                                    <td>{{ (!empty($bug->assignTo)?$bug->assignTo->name:'') }}</td>
                                    <td>{{ $bug->title}}</td>
                                    <td>{{ Auth::user()->dateFormat($bug->start_date) }}</td>
                                    <td>{{ Auth::user()->dateFormat($bug->due_date) }}</td>
                                    <td>{{ (!empty($bug->bug_status)?$bug->bug_status->title:'') }}</td>
                                    <td>{{ $bug->priority }}</td>
                                    <td>{{ $bug->createdBy->name }}</td>
                                    <td class="Action" width="10%">
                                        @can('edit bug report')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-size="lg" class="mx-3 btn btn-sm align-items-center" data-url="{{ route('task.bug.edit',[$project->id,$bug->id]) }}" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Edit Bug')}}">
                                                    <i class="text-white ti ti-pencil"></i>
                                                </a>
                                            </div>
                                        @endcan
                                        @can('delete bug report')
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['task.bug.destroy', $project->id,$bug->id]]) !!}
                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}"><i class="text-white ti ti-trash"></i></a>
                                                {!! Form::close() !!}
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
