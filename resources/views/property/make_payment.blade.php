@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Payments') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Payments') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection


@section('content')

    @if ($firstInstallment && $firstInstallment->status == 0)
        <form action="{{ url('make-payment-store') }}" method="post">
            @csrf
            <input type="hidden" name="invoice_id" value="{{ $deal->id }}">
            <input type="hidden" name="payment_plan_id" value="{{ $firstInstallment->id }}">

            <div class="form-group">
                <label for="installment_name">Installment Name</label>
                <input type="text" class="form-control" name="installment_name"
                    value="{{ $firstInstallment->installment_name }}" readonly>
            </div>
            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" class="form-control" name="payment_date">
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" name="due_date" value="{{ $firstInstallment->due_date }}">
            </div>
            <div class="form-group">
                <label for="paid_amount">Amount</label>
                <input type="text" class="form-control" name="paid_amount"
                    value="{{ $firstInstallment->installment_price }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Payment</button>
        </form>
    @else
        {{-- Find the next unpaid installment --}}
        @php
            $nextInstallment = $installments->first(function ($installment) {
                return $installment->status == 0; // Assuming '0' indicates unpaid status
            });

        @endphp

        @if ($nextInstallment)
            {{-- Display next installment form --}}
            <form action="{{ url('make-payment-store') }}" method="post">
                @csrf
                <input type="text" name="invoice_id" value="{{ $deal->id }}">
                <input type="text" name="payment_plan_id" value="{{ $nextInstallment->id }}">

                <div class="form-group">
                    <label for="installment_name">Installment Name</label>
                    <input type="text" class="form-control" name="installment_name"
                        value="{{ $nextInstallment->installment_name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <input type="date" class="form-control" name="payment_date">
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" name="due_date" value="{{ $nextInstallment->due_date }}">
                </div>
                <div class="form-group">
                    <label for="paid_amount">Amount</label>
                    <input type="text" class="form-control" name="paid_amount"
                        value="{{ $nextInstallment->installment_price }}">
                </div>

                <button type="submit" class="btn btn-primary">Save Payment</button>
            </form>
        @else
            {{-- All installments are paid --}}
            <p>All installments have been paid.</p>
        @endif
    @endif

    {{-- if ($nextInstallment) {
            // Show payment form for the next unpaid installment
            return view('pay_installment', ['installment' => $nextInstallment]);
        } else {
            // All installments are paid
            return redirect()->back()->with('message', 'All installments have been paid.');
        }
    @ --}}






    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
@endsection
