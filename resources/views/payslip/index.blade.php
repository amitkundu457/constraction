@extends('layouts.admin')

@section('page-title')
    {{ __('Payslip') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('payslip') }}</li>
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => ['payslip.store'], 'method' => 'POST', 'id' => 'payslip_form']) }}
                <div class="d-flex align-items-center justify-content-end">
                    <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                        <div class="btn-box">
                            {{ Form::label('month', __('Select Month'), ['class' => 'form-label']) }}
                            {{ Form::select('month', $month, date('m'), ['class' => 'form-control select', 'id' => 'month']) }}
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                        <div class="btn-box">
                            {{ Form::label('year', __('Select Year'), ['class' => 'form-label']) }}
                            {{ Form::select('year', $year, date('Y'), ['class' => 'form-control select']) }}
                        </div>
                    </div>
                    <div class="col-auto float-end ms-2 mt-4">
                        <a href="#" class="btn  btn-primary"
                            onclick="document.getElementById('payslip_form').submit(); return false;"
                            data-bs-toggle="tooltip" title="{{ __('payslip') }}"
                            data-original-title="{{ __('payslip') }}">{{ __('Generate Payslip') }}
                        </a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center justify-content-start mt-2">
                            <h5>{{ __('Find Employee Payslip') }}</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex align-items-center justify-content-end ">
                            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    <select class="form-control month_date " name="year" tabindex="-1"
                                        aria-hidden="true">
                                        <option value="--">--</option>
                                        @foreach ($month as $k => $mon)
                                            @php
                                                $selected = date('m') == $k ? 'selected' : '';
                                            @endphp
                                            <option value="{{ $k }}" {{ $selected }}>{{ $mon }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 me-2">
                                <div class="btn-box">
                                    {{ Form::select('year', $year, date('Y'), ['class' => 'form-control year_date']) }}
                                </div>
                            </div>
                            <div class="col-auto float-end me-2">
                                {{ Form::open(['route' => ['payslip.export'], 'method' => 'POST', 'id' => 'payslip_form']) }}
                                <input type="hidden" name="filter_month" class="filter_month">
                                <input type="hidden" name="filter_year" class="filter_year">
                                <input type="submit" value="{{ __('Export') }}" class="btn btn-primary">
                                {{ Form::close() }}
                            </div>
                            {{-- <div class="col-auto float-end me-0">
                                @can('create pay slip')
                                    <input type="button" value="{{ __('Bulk Payment') }}" class="btn btn-primary"
                                        id="bulk_payment">
                                @endcan
                            </div> --}}
                            <a class="btn btn-primary" href="{{ url('payslip/bulk_send',date('y-m')) }}">Bulk Send Payslip</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-render-column-cells">
                        <thead>
                            <tr>
                                <th>{{ __('Employee Id') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Payroll Type') }}</th>
                                <th>{{ __('Salary') }}</th>
                                <th>{{ __('Net Salary') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <div class="d-flex gap-1">
                                            <h5 class="text-info">01 - 30 Jun, 24</h5>
                                            <p class="text-secondary" style="font-size: 13px; font-weight:600">includes 3 employees</p>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <p class="">Monthly - None Based |</p>
                                            <p class=""><span class="h5 text-info">Mannual</span> - followed by customized</p>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <h5 class="text-info">ID :</h5>
                                            <p class="text-secondary" style="font-size: 13px; font-weight:600">ADCXYZ</p>
                                        </div>
                                        <div class="d-flex gap-2">
                                           <button class="btn btn-sm border border-secondary text-secondary">View Payslip</button>
                                            <button class="btn btn-sm border border-danger text-danger"><i class="ti ti-download"></i> Export</button>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td colspan="3">
                                    <div>
                                        <div>
                                            <span class="bg-secondary px-2 rounded-pill text-white" style="font-weight: 600">Generated</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-1" style="font-size:13px;""> 
                                            <p class="text-secondary"><i class="ti ti-calendar"></i></p>
                                            <p class="text-secondary" style="font-size:13px;">Created At</p>
                                            <p style="font-size:13px;">Today</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-1" style="font-size:13px;""> 
                                            <p class="text-secondary"><i class="ti ti-user-check"></i></p>
                                            <p class="text-secondary" style="font-size:13px;">Not yet send</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-1" style="font-size:13px;""> 
                                            <p class="text-secondary"><i class="ti ti-flag"></i></p>
                                            <p style="font-size:13px; font-weight: 600; color:#ff7200;">Payslip of 2 employees are conflicted <a href="#" style="color:#075cdb">Manage</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">{{ __('Payment Details') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ valueOfElement[2] }}
                        <p>{{ __('Please enter the payment details.') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="button" class="btn btn-primary">{{ __('Confirm Payment') }}</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('script-page')
    {{-- <script>
        $(document).ready(function() {
            callback();

            function callback() {
                var month = $(".month_date").val();
                var year = $(".year_date").val();

                $('.filter_month').val(month);
                $('.filter_year').val(year);

                if (month == '') {
                    month = '{{ date('m', strtotime('last month')) }}';
                    year = '{{ date('Y') }}';

                    $('.filter_month').val(month);
                    $('.filter_year').val(year);
                }

                var datePicker = year + '-' + month;

                $.ajax({
                    url: '{{ route('payslip.search_json') }}',
                    type: 'POST',
                    data: {
                        "datePicker": datePicker,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        var datatable_data = {
                            data: data
                        };

                        function renderstatus(data, cell, row) {
                            if (data == 'Paid')
                                return '<div class="badge bg-success p-2 px-3 rounded"><a href="#" class="text-white">' +
                                    data + '</a></div>';
                            else
                                return '<div class="badge bg-danger p-2 px-3 rounded"><a href="#" class="text-white">' +
                                    data + '</a></div>';
                        }

                        function renderButton(data, cell, row) {

                            var $div = $(row);
                            employee_id = $div.find('td:eq(0)').text();
                            status = $div.find('td:eq(6)').text();

                            var month = $(".month_date").val();
                            var year = $(".year_date").val();
                            var id = employee_id;
                            var payslip_id = data;


                            var clickToPaid = '';
                            var payslip = '';
                            var view = '';
                            var edit = '';
                            var deleted = '';
                            var form = '';

                            if (data != 0) {
                                var payslip =
                                    '<a href="#" data-url="{{ url('payslip/pdf/') }}/' + id +
                                    '/' + datePicker +
                                    '" data-size="md-pdf"  data-ajax-popup="true" class="btn btn-primary" data-title="{{ __('Employee Payslip') }}">' +
                                    '{{ __('Payslip') }}' + '</a> ';
                            }

                            if (status == "UnPaid" && data != 0) {
                                clickToPaid =
                                    '<a href="#" data-url="{{ url('payslip/pdf/') }}/' + id +
                                    '/' + datePicker +
                                    '" data-size="md-pdf"  data-ajax-popup="true" class="btn btn-primary" data-title="{{ __('Employee Payslip') }}">' +
                                    '{{ __('Payslip') }}' + '</a>';
                            }

                            if (data != 0) {
                                view =
                                    '<a href="#" data-url="{{ url('payslip/showemployee/') }}/' +
                                    payslip_id +
                                    '"  data-ajax-popup="true" class="view-btn gray-bg" data-title="{{ __('View Employee Detail') }}">' +
                                    '{{ __('View') }}' + '</a>';
                            }

                            if (data != 0 && status == "UnPaid") {
                                edit =
                                    '<a href="#" data-url="{{ url('payslip/editemployee/') }}/' +
                                    payslip_id +
                                    '"  data-ajax-popup="true" class="view-btn blue-bg" data-title="{{ __('Edit Employee salary') }}">' +
                                    '{{ __('Edit') }}' + '</a>';
                            }

                            var url = '{{ route('payslip.delete', ':id') }}';
                            url = url.replace(':id', payslip_id);

                            @if (\Auth::user()->type != 'Employee')
                                if (data != 0) {
                                    deleted = '<a href="#"  data-url="' + url +
                                        '" class="payslip_delete view-btn red-bg" >' +
                                        '{{ __('Delete') }}' + '</a>';
                                }
                            @endif

                            return view + payslip + clickToPaid + edit + deleted + form;
                        }

                        console.clear();
                        var tr = '';
                        // <tr><td class="dataTables-empty" colspan="1">No entries found</td></tr>
                        if (data.length > 0) {
                            console.log(data);
                            var tr = ''; // Initialize tr outside the loop
                            $.each(data, function(indexInArray, valueOfElement) {
                                var status =
                                    '<div class="badge bg-danger p-2 px-3 rounded"><a href="#" class="text-white">' +
                                    valueOfElement[6] + '</a></div>';
                                if (valueOfElement[6] == 'Paid') {
                                    status =
                                        '<div class="badge bg-success p-2 px-3 rounded"><a href="#" class="text-white">' +
                                        valueOfElement[6] + '</a></div>';
                                }

                                var id = valueOfElement[0];
                                var employee_id = valueOfElement[1];
                                var payslip_id = valueOfElement[7];

                                var payslip = '';
                                if (valueOfElement[7] != 0) {
                                    payslip =
                                        '<a href="#" data-url="{{ url('payslip/pdf/') }}/' +
                                        id + '/' + datePicker +
                                        '" data-size="lg" data-ajax-popup="true" class="btn-sm btn btn-warning" data-title="{{ __('Employee Payslip') }}">' +
                                        '{{ __('Payslip') }}' + '</a> ';
                                }

                                var clickToPaid = '';
                                if (valueOfElement[6] == "UnPaid" && valueOfElement[7] != 0) {
                                    clickToPaid =
                                        '<a href="#" data-url="{{ url('payslip/payslippay/') }}/' +
                                        id +
                                        '/' + datePicker +
                                        '" data-size="lg" data-ajax-popup="true" class="btn-sm btn btn-warning" data-title="{{ __('Employee Payslip') }}">' +
                                        '{{ __('Click To Paid') }}' + '</a> ';
                                }

                                var edit = '';
                                if (valueOfElement[7] != 0 && valueOfElement[6] == "UnPaid") {
                                    edit =
                                        '<a href="#" data-url="{{ url('payslip/editemployee/') }}/' +
                                        payslip_id +
                                        '" data-ajax-popup="true" class="btn-sm btn btn-info" data-title="{{ __('Edit Employee salary') }}">' +
                                        '{{ __('Edit') }}' + '</a>';
                                }

                                var url = '{{ route('payslip.delete', ':id') }}';
                                url = url.replace(':id', payslip_id);

                                @if (\Auth::user()->type != 'Employee')
                                    var deleted = '';
                                    if (valueOfElement[7] != 0) {
                                        deleted = '<a href="#" data-url="' + url +
                                            '" class="payslip_delete view-btn btn btn-danger ms-1 btn-sm">' +
                                            '{{ __('Delete') }}' + '</a>';
                                    }
                                @endif

                                var url_employee = valueOfElement['url'];

                                tr +=
                                    '<tr>' +
                                    '<td><a class="btn btn-outline-primary" href="' +
                                    url_employee + '">' + valueOfElement[1] + '</a></td>' +
                                    '<td>' + valueOfElement[2] + '</td>' +
                                    '<td>' + valueOfElement[3] + '</td>' +
                                    '<td>' + valueOfElement[4] + '</td>' +
                                    '<td>' + valueOfElement[5] + '</td>' +
                                    '<td>' + status + '</td>' +
                                    '<td>' + payslip + clickToPaid + edit + deleted + '</td>' +
                                    '</tr>';
                            });

                            // Append the rows to the table body
                            $('#your-table-id tbody').html(tr);

                        } else {
                            var colspan = $('#pc-dt-render-column-cells thead tr th').length;
                            var tr = '<tr><td class="dataTables-empty" colspan="' + colspan +
                                '">{{ __('No entries found') }}</td></tr>';
                            $('#your-table-id tbody').html(
                                tr); // Make sure to update the table body with this row
                        }


                        $('#pc-dt-render-column-cells tbody').html(tr);
                        var table = document.querySelector("#pc-dt-render-column-cells");
                        var datatable = new simpleDatatables.DataTable(table);

                        // if (data.length > 0) {
                        //     var dataTable = new simpleDatatables.DataTable(
                        //         "#pc-dt-render-column-cells", {
                        //             data: datatable_data,
                        //             perPage: 25,
                        //             columns: [{
                        //                     select: 0,
                        //                     hidden: true
                        //                 },
                        //                 {
                        //                     select: 6,
                        //                     render: renderstatus
                        //                 },
                        //                 {
                        //                     select: 7,
                        //                     render: renderButton
                        //                 }
                        //             ]
                        //         }
                        //     );


                        //     $('[data-toggle="tooltip"]').tooltip();

                        //     if (!(data)) {
                        //         show_toastr('error',
                        //             'Employee payslip not found ! please generate first.',
                        //             'error');
                        //     }
                        // } else {

                        //     var dataTable = new simpleDatatables.DataTable(
                        //         "#pc-dt-render-column-cells", {
                        //             data: ''
                        //         }
                        //     );

                        // }
                        // dataTable.on("datatable.init");


                    },
                    error: function(data) {

                    }

                });

            }

            $(document).on("change", ".month_date,.year_date", function() {
                callback();
            });

            //bulkpayment Click
            $(document).on("click", "#bulk_payment", function() {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '_' + month;


            });
            $(document).on('click', '#bulk_payment',
                'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]',
                function() {
                    var month = $(".month_date").val();
                    var year = $(".year_date").val();
                    var datePicker = year + '-' + month;

                    var title = 'Bulk Payment';
                    var size = 'md';
                    var url = 'payslip/bulk_pay_create/' + datePicker;

                    // return false;

                    $("#commonModal .modal-title").html(title);
                    $("#commonModal .modal-dialog").addClass('modal-' + size);
                    $.ajax({
                        url: url,
                        success: function(data) {
                            console.log(data);
                            // alert(data);
                            // return false;
                            if (data.length) {
                                $('#commonModal .body').html(data);
                                $("#commonModal").modal('show');
                                // common_bind();
                            } else {
                                show_toastr('error', 'Permission denied.');
                                $("#commonModal").modal('hide');
                            }
                        },
                        error: function(data) {
                            data = data.responseJSON;
                            show_toastr('error', data.error);
                        }
                    });
                });

            $(document).on("click", ".payslip_delete", function() {
                var confirmation = confirm("are you sure you want to delete this payslip?");
                var url = $(this).data('url');


                if (confirmation) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data);


                            // show_toastr(data.status, data.msg, 'data.status');
                            show_toastr('success', 'Payslip Deleted Successfully', 'success');


                            setTimeout(function() {
                                location.reload();
                            }, 800)


                        },

                    });

                }
            });
        });
    </script> --}}
@endpush
