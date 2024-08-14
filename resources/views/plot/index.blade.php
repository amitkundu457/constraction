@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Plot') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Plot') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="{{ route('plot.create') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection



@section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
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
                            <th>Owner Name</th>
                            <th>Project name</th>
                            <th>Area (SQFt.)</th>
                            <th>Phone No.</th>
                            <th>Total Plots</th>
                            <th> TimeStamp</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($plots as $plot)
                            <tr>
                                <td>{{ $count }}</td>

                                <td>{{ $plot->owner($plot->owner_id)->name }}</td>
                                <td>{{ $plot->project($plot->project_id)->project_name }}</td>
                                <td>{{ $plot->block_name }}</td>
                                <td>
                                    {{ $plot->phone_no }}
                                </td>


                                <td>
                                    {{ $plot->total_plots }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($plot->created_at)->format('d M,Y h:i A') }}
                                </td>


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a href="{{ route('plot.edit', $plot->id) }}" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil"></i> </a>
                                        {{-- <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ url('property-document', $propertie->id) }}">
                                            <i class="ti ti-file"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="{{ url('property-photo', $propertie->id) }}">
                                            <i class="ti ti-file"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"><i
                                                class="fa fa-eye m-r-5"></i> </a> --}}
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete_modal-{{$plot->id}}"
                                            data-id="{{ $plot->id }}">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-{{$plot->id}}" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        {{-- <h3>Delete {{ ucfirst($title) }}</h3> --}}
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete this record?</h5>
                                                        
                                                    </div>
                                                    <form action="{{ route('plot.delete', $plot->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" data-dismiss="modal"
                                                                        class="btn btn-danger cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
