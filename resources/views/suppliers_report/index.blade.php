@extends('layouts.admin')
@section('page-title')
    {{ __('Supplier Reports') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Supplier Reports') }}</li>
@endsection
@push('script-page')
    <script>
        $('.copy_link').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        });
    </script>
@endpush


@section('action-btn')
    <div class="float-end d-flex align-items-center gap-4">
        
        <form action="{{route('reports.suppliers')}}" id="form" class="d-flex gap-2 " x-data="">
            <div class="form-group">
                <label for="">Select Supplier</label>
                <select name="s" x-on:change="$event.target.value == '' ? window.location.href='{{route('reports.suppliers') }}' : document.querySelector('#form').submit()" id="" class="form-control">
                    <option value="">Select Supplier</option>
                    @foreach (\App\Models\Company::all() as $s)
                        <option value="{{ $s->name }}" @selected(request()->query('s') == $s->name)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Select Material</label>
                <select name="m" id="" x-on:change="$event.target.value == '' ? window.location.href='{{route('reports.suppliers') }}' : document.querySelector('#form').submit()" class="form-control">
                    <option value="">Select Material</option>
                    @foreach (\App\Models\ProductService::all() as $mat)
                    <option value="{{ $mat->name }}">{{ $mat->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        @can('create purchase')
            <a href="{{ route('reports.suppliers.create') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                title="{{ __('Create') }}">
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
                                    <th> {{ __('Purchase') }}</th>
                                    <th> {{ __('Site location') }}</th>
                                    <th> {{ __('Suppliers') }}</th>
                                    <th> {{ __('Products') }}</th>
                                    <th> {{ __('Amount') }}</th>
                                    <th>{{ __('Purchase Date') }}</th>
                                    <th> {{ __('Action') }}</th>
                                    {{-- <th> {{ __('Category') }}</th> --}}
                                    {{-- @if (Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($sreps as $sr)
                                    <tr>
                                        <td class="Id">
                                            <a href="#" class="btn btn-outline-primary">
                                                {{ '#SUP-' . str_pad($sr->id, 4, '0', STR_PAD_LEFT) }}
                                            </a>

                                        </td>

                                        <td>{{ $sr->vender->name }} </td>
                                        <td> {{ $sr->supplierReportProducts->count('suppliers_id') }} </td>

                                        {{-- {{ <td>{{ !empty($purchase->category) ? $purchase->category->name : '' }}</td> }} --}}
                                        <td>
                                            {{ $sr->supplierReportProducts->count('product_id') }}
                                        </td>
                                        <td>
                                            @php
                                            $price = 0;
                                                foreach ($sr->supplierReportProducts as $item) {
                                                   $price += $item->quantity * $item->price;
                                                }
                                            @endphp
                                            &#8377;{{ $price }}
                                        </td>
                                        <td>{{ Auth::user()->dateFormat($sr->created_at) }}</td>
                                        {{-- <td>
                                            @if ($purchase->status == 0)
                                                <span
                                                    class="purchase_status badge bg-secondary p-2 px-3 rounded">{{ __(\App\Models\Purchase::$statues[$purchase->status]) }}</span>
                                            @elseif($purchase->status == 1)
                                                <span
                                                    class="purchase_status badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Purchase::$statues[$purchase->status]) }}</span>
                                            @elseif($purchase->status == 2)
                                                <span
                                                    class="purchase_status badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Purchase::$statues[$purchase->status]) }}</span>
                                            @elseif($purchase->status == 3)
                                                <span
                                                    class="purchase_status badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Purchase::$statues[$purchase->status]) }}</span>
                                            @elseif($purchase->status == 4)
                                                <span
                                                    class="purchase_status badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\Purchase::$statues[$purchase->status]) }}</span>
                                            @endif
                                        </td> --}}



                                        @if (Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase'))
                                            <td class="Action">
                                                <span>

                                                    @can('show purchase')
                                                        <div class="action-btn bg-info ms-2">
                                                            <a data-bs-toggle="modal" data-bs-target="#showmodal-{{ $sr->id }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="{{ __('Show') }}"
                                                                data-original-title="{{ __('Detail') }}">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('edit purchase')
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="{{ route('reports.suppliers.edit', $sr->id) }}"
                                                                class="mx-3 btn btn-sm align-items-center"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                data-original-title="{{ __('Edit') }}">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    {{-- @can('delete purchase')
                                                        <div class="action-btn bg-danger ms-2">
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['purchase.destroy', $purchase->id],
                                                                'class' => 'delete-form-btn',
                                                                'id' => 'delete-form-' . $purchase->id,
                                                            ]) !!}
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                                data-original-title="{{ __('Delete') }}"
                                                                data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-form-{{ $purchase->id }}').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endcan --}}
                                                </span>
                                            </td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="showmodal-{{ $sr->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Supplier Report</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row border-bottom mb-4">
                                                        <div class="col-2">
                                                            <h6>Supplier</h6>
                                                        </div>
                                                        <div class="col-2">
                                                            <h6>Product</h6>
                                                        </div>
                                                        <div class="col-1">
                                                            <h6>Price</h6>
                                                        </div>
                                                        <div class="col-1">
                                                            <h6>Qnty</h6>
                                                        </div>
                                                        <div class="col-2">
                                                            <h6>Total Price</h6>
                                                        </div>
                                                        <div class="col-2">
                                                            <h6>Due</h6>
                                                        </div>
                                                        <div class="col-2">
                                                            <h6>Is Paid</h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($sr->supplierReportProducts as $item)
                                                            <div class="col-2">
                                                                <p>{{ $item->company->name }}
                                                                </p>
                                                            </div>
                                                            <div class="col-2">
                                                                <p>{{ $item->productService->name }}
                                                                </p>
                                                            </div>
                                                            <div class="col-1">
                                                                <p>&#8377; {{ $item->price }}</p>
                                                            </div>
                                                            <div class="col-1">
                                                                <p>{{ $item->quantity }}</p>
                                                            </div>
                                                            <div class="col-2">
                                                                <p>&#8377;
                                                                    {{ $item->price * $item->quantity }}
                                                                </p>
                                                            </div>
                                                            <div class="col-2">
                                                                <p>
                                                                    &#8377;{{ $item->price * $item->quantity - $item->paid_amount }}
                                                                </p>
                                                            </div>
                                                            <div class="col-2">
                                                                @if ($item->price * $item->quantity == $item->paid_amount)
                                                                <p class="badge bg-success">Paid</p>
                                                                @else
                                                                <p class="badge bg-danger">Due</p>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
