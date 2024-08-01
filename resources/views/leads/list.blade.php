@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Leads') }} {{-- @if ($pipeline) - {{$pipeline->name}} @endif --}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{ asset('css/summernote/summernote-bs4.css') }}">
@endpush
@push('script-page')
    <script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function() {
            $('#change-pipeline').submit();
        });
    </script>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Lead') }}</li>
@endsection
@section('action-btn')
    <div class="float-end d-flex align-items-center gap-1">
        <form id="stage" action="{{ url('leads/list') }}" x-data="{ query:'{{ request()->query('stage') }}' }">
            <select name="stage" x-model="query" x-on:change="document.querySelector('#stage').submit()"
                class=" form-control-sm" id="">
                <option value="all">All Stage</option>
                @foreach ($stages as $stage)
                <option value="{{ strtolower($stage->name) }}" >{{ $stage->name }}</option>
                @endforeach
            </select>
            
        </form>
        <form id="filter" action="{{ url('leads/list') }}" x-data="{ query:'{{ request()->query('filter') }}' }">
            <select name="filter" x-model="query" x-on:change="document.querySelector('#filter').submit()"
                class=" form-control-sm" id="">
                <option value="all">All Leads</option>
                <option value="todays" :selected="query === 'todays'">Today's Leads</option>
                <option value="upcoming" :selected="query === 'upcoming'">Upcoming Leads</option>
                <option value="past" :selected="query === 'past'">Past Lead</option>
            </select>
            
        </form>
        <a href="{{ route('leads.index') }}" data-bs-toggle="tooltip" title="{{ __('Kanban View') }}"
            class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>
        <a href="#" data-size="lg" data-url="{{ route('leads.create') }}" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="{{ __('Create New User') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    {{-- @if ($pipeline) --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Subject') }}</th>
                                    <th>{{ __('Lead Stage') }}</th>
                                    <th>{{ __('Lead Source') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('TIMESTAMP') }}</th>
                                    {{-- <th>{{__('Users')}}</th> --}}
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($leads) > 0)
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <td>{{ $lead->name }}</td>
                                            <td>{{ $lead->subject }}</td>
                                            <td>{{ \App\Models\Pipeline::findOrFail($lead->pipeline_id)->name }}
                                            </td>
                                            <td>{{ \App\Models\Source::findOrFail($lead->source)->name }}
                                            <td>{{ \App\Models\LeadStage::findOrFail($lead->stage_id)->name }}
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($lead->date)->format('d-M-Y') }}</td>
                                            {{-- <td>
                                                @foreach ($lead->users as $user)
                                                    <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                        <img alt="image" data-toggle="tooltip" data-original-title="{{$user->name}}" @if ($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif class="rounded-circle " width="25" height="25">
                                                    </a>
                                                @endforeach
                                            </td> --}}
                                            @if (Auth::user()->type != 'client')
                                                <td class="Action">
                                                    <span>
                                                        @can('view lead')
                                                            @if ($lead->is_active)
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a href="{{ route('leads.show', $lead->id) }}"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-size="xl" data-bs-toggle="tooltip"
                                                                        title="{{ __('View') }}"
                                                                        data-title="{{ __('Lead Detail') }}">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endcan
                                                        @can('edit lead')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                    data-url="{{ route('leads.edit', $lead->id) }}"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-bs-toggle="tooltip" title="{{ __('Edit') }}"
                                                                    data-title="{{ __('Lead Edit') }}">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('delete lead')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['leads.destroy', $lead->id],
                                                                    'id' => 'delete-form-' . $lead->id,
                                                                ]) !!}
                                                                <a href="#"
                                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title="{{ __('Delete') }}"><i
                                                                        class="ti ti-trash text-white"></i></a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                @endif
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="mailto:admin@ecspvt.com" class="mx-3 btn btn-sm  align-items-center "
                                                        data-bs-toggle="tooltip" title="{{ __('Mail') }}"><i
                                                            class="ti ti-mail text-white"></i></a>
                                                </div>
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="tel:8910346789" class="mx-3 btn btn-sm  align-items-center "
                                                        data-bs-toggle="tooltip" title="{{ __('Call') }}"><i
                                                            class="ti ti-phone text-white"></i></a>
                                                </div>
                                                </span>
                                                </td>
                                        @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}
        <script></script>
    @endsection
