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


    <form action="{{ url('show-payment-store') }}" method="post">
        @csrf
        <input type="hidden" name="deal_id" value="{{ $deal->id }}">
        @for ($i = 1; $i <= $deal->ins_number; $i++)
            <div class="card" style="padding: 2rem">
                <div class="form-group">
                    <label for="installment-name-{{ $i }}">Name</label>
                    <input type="text" class="form-control" name="installments[{{ $i }}][installment_name]"
                        value="{{ $i }} installment">
                </div>
                <div class="form-group">
                    <label for="installment-amount-{{ $i }}">Amount</label>
                    <input type="text" name="installments[{{ $i }}][installment_price]"
                        id="installment-amount-{{ $i }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="installment-amount-{{ $i }}">Amount</label>
                    <input type="date" name="installments[{{ $i }}][due_date]" class="form-control">
                </div>
            </div>
        @endfor
        <button type="submit" class="btn btn-primary">Save Installments</button>
    </form>





    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
