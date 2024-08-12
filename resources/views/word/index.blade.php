@extends('layouts.admin')
@section('page-title')
    {{ __('Word Online') }}
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="{{ route('word.create') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th> TimeStamp</th>
                            <th class="text-end" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($words as $word)
                            <tr>
                                <td>{{ $count }}</td>

                                <td>{{ $word->name }} </td>
                                <td>{{ Carbon\Carbon::parse($word->created_at)->format('d M, y h:i A') }}</td>
                                <td class="text-end">
                                    <div class="" style="display: flex; justify-content: end">
                                        <a href="{{ route('word.edit', $word->id) }}" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil"></i> </a>

                                        {{-- @if ($word->share()->where('word_id', $word->id)->exists())
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['word.share.destroy', $word->id],
                                                'id' => 'delete-form-' . $word->id,
                                            ]) !!}
                                            <button type="button" class="btn btn-sm btn-warning bs-pass-para"
                                                style="margin-left: 0.5rem" data-bs-toggle="tooltip"
                                                title="{{ __('Delete') }}" data-original-title="{{ __('Delete') }}"
                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                data-confirm-yes="document.getElementById('delete-form-{{ $word->id }}').submit();">
                                                <i class="ti ti-x"></i>
                                            </button>
                                            {!! Form::close() !!}
                                            <a href="{{ route('word.share.show', $word->id) }}"
                                                class="btn btn-sm btn-info" style="margin-left: 0.5rem"><i
                                                    class="fa fa-eye "></i> </a>
                                        @else --}}
                                        {{-- <button class="btn btn-sm btn-secondary"
                                                data-target="#share_{{ $word->id }}" data-toggle="modal"
                                                style="margin-left: 0.5rem">
                                                <i class="ti ti-share"></i>
                                            </button> --}}
                                        {{-- @endif  --}}
                                        <a class="btn btn-sm btn-secondary" style="margin-left: 0.5rem"
                                            href="{{ route('word.show', $word->id) }}">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger " style="margin-left: 0.5rem"
                                            href="javascript:void(0)">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    {{-- <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="{{ url('property-delete', $word->id) }}"
                                                        method="get">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <button data-dismiss="modal"
                                                                        class="btn btn-primary cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="modal custom-modal fade" id="share_{{ $word->id }}" role="dialog">
                                        <div class="modal-dialog modal-lg " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Share word</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <form action="{{ route('word.share', $word->id) }}" method="post"
                                                        x-data="{ type: 1 }">
                                                        @csrf
                                                        <div class="row my-2">
                                                            <p>Whom do you want to share</p>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="type"
                                                                        x-on:click="type = $event.target.value"
                                                                        value="1" checked />
                                                                    <label class="form-check-label" for="">Employee
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="type"
                                                                        x-on:click="type = $event.target.value"
                                                                        value="2" />
                                                                    <label class="form-check-label" for="">Customer
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div id="emp" class="form-group"
                                                                x-bind:class="type == 2 ? 'd-none' : ''">
                                                                <label for="" class="form-label">Employee</label>
                                                                <select name="employee_id" class="form-control">
                                                                    <option value="">--Select Employee --</option>
                                                                    @foreach ($employees as $emp)
                                                                        <option value="{{ $emp->id }}">
                                                                            {{ $emp->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div id="cust" class="form-group"
                                                                x-bind:class="type == 1 ? 'd-none' : ''">
                                                                <label for="" class="form-label">Customer</label>
                                                                <select name="user_id" class="form-control">
                                                                    <option value="">--Select Customer --</option>
                                                                    @foreach ($users as $emp)
                                                                        <option value="{{ $emp->id }}">
                                                                            {{ $emp->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row my-2">
                                                            <p>Permissions</p>
                                                            <div class="">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" name="is_editable"
                                                                        type="checkbox" role="switch"
                                                                        id="flexSwitchCheckDefault" checked>
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchCheckDefault">Edit</label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" name="is_viewable"
                                                                        type="checkbox" role="switch"
                                                                        id="flexSwitchCheckDefault" checked>
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchCheckDefault">View</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="submit-section">
                                                            <button type="submit"
                                                                class="btn btn-primary submit-btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
