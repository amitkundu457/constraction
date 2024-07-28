@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Promotion') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Promotion') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection





@section('content')
    {{ $deal->id }}

    <table class="table border">
        <thead>
            <tr>
                <th> ID</th>
                <th>Payment Name</th>
                <th>Payment Date</th>
                <th>Total Amount</th>

                <th>Payment Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $call)
                <tr>
                    <td>{{ $call->id }}</td>
                    <td>{{ $call->installment_name }}</td>

                    <td>{{ $call->payment_date }}</td>
                    <td>{{ $call->paid_amount }}</td>
                    <td>{{ $call->payment_typee }}</td>
                    {{-- <td>{{ $call->status }}</td> --}}
                    {{-- <td>
                        <a href="{{ route('calls.edit', $call->id) }}" class="btn btn-sm btn-btn-primary">Edit</a>
                    </td> --}}
                </tr>
            @endforeach
    </table>






    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
