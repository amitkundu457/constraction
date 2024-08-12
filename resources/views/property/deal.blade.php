@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Deal') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Deal') }}</li>
@endsection
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                            <th>Client Name</th>
                            <th>Property Name</th>
                            <th>invoice No</th>
                            <th>invoice date</th>
                            <th>area</th>
                            <th>total amount</th>
                            <th>Due blance</th>
                            <th>Status</th>



                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($deal as $propertie)
                            <tr>
                                <td>{{ $count }}</td>

                                <td>{{ $propertie->firstname . '  ' . $propertie->lastname }}</td>
                                <td>{{ $propertie->title }}</td>
                                <td>{{ $propertie->invoice_id }}</td>
                                <td>{{ $propertie->invoice_date }}</td>
                                <td>{{ $propertie->area }}</td>
                                <td>{{ $propertie->price }}</td>
                                @php
                                    $due = $propertie->price - $propertie->booking_amount;
                                    $installments = App\Models\Installment::where('deal_id', $propertie->id)
                                        ->orderBy('due_date')
                                        ->get();
                                    $firstInstallment = $installments->first();
                                    $nextInstallment = $installments->first(function ($installment) {
                                        return $installment->status == 0; // Assuming '0' indicates unpaid status
                                    });
                                @endphp

                                <td>{{ $due }}</td>
                                <td>
                                    @if ($firstInstallment && $firstInstallment->status == 0)
                                        <span class="text-danger">Unpaid</span>
                                    @else
                                        @if ($nextInstallment)
                                            <div class="bg-danger text-center">Unpaid</div>
                                        @else
                                            {{-- All installments are paid --}}
                                            <div class="bg-success text-center">paid</div>
                                        @endif
                                    @endif


                                </td>



                                <td class="text-end">

                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li style="font-size: 14px"><a data-toggle="modal"
                                                    data-target="#edit_modal-{{ $propertie->id }}"
                                                    data-id="{{ $propertie->id }}" class="dropdown-item"> Edit</a></li>
                                            <li style="font-size: 14px"> <a class="dropdown-item"
                                                    href="{{ url('make-payment', $propertie->id) }}">Make Payment</a></li>
                                            <li style="font-size: 14px"><a class="dropdown-item"
                                                    href="{{ url('make-payment-history', $propertie->id) }}">Payment
                                                    History</a></li>
                                            <li style="font-size: 14px"> <a class="dropdown-item"
                                                    href="{{ url('show-payment', $propertie->id) }}">Payment Plan</a></li>
                                            <li style="font-size: 14px"> <a class="dropdown-item deletebtn"
                                                    href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#delete_modal" data-id="{{ $propertie->id }}">
                                                    Delete
                                                </a></li>
                                        </ul>
                                    </div>

                                    <div class="modal custom-modal fade" id="edit_modal-{{ $propertie->id }}"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Type {{ $propertie->id }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('payment-plan-update', $propertie->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="{{ $propertie->name }}" type="text"
                                                                name="name" id="edit_checkin" class="form-control">
                                                        </div>



                                                        {{-- <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%">{{ $propertie->note }}</textarea>
                                                        </div> --}}
                                                        <div class="submit-section">
                                                            <button type="submit"
                                                                class="btn btn-primary submit-btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        {{-- <h3>Delete {{ ucfirst($title) }}</h3> --}}
                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="{{ url('payment-plan-delete', $propertie->id) }}"
                                                        method="get">
                                                        {{-- @method('DELETE') --}}
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
                                    </div>
                                </td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        <div class="d-flex justify-content-center">
                            {{-- {{ $type->links() }} --}}
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Plans</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" x-data="propertyPrices()">
                        <form action="{{ url('deal-store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Client Name <span class="text-danger">*</span></label>
                                    <select name="client_id" class="form-control" id="">
                                        <option value="">Client Name</option>
                                        @foreach ($client as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->firstname }}
                                                {{ $clients->lastname }}</option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="form-group col-4">
                                    <label>Property Type <span class="text-danger">*</span></label>
                                    <select name="type_id" class="form-control" id="">
                                        <option value="">property Type</option>
                                        @foreach ($type as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->type_name }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="form-group col-4">
                                    <label>Available For <span class="text-danger">*</span></label>
                                    <select name="contract_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        @foreach ($contrct as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->contruct_name }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-4" x-model="selectedPropertyId" @change="fetchPrices">
                                    <label>Property name <span class="text-danger">*</span></label>
                                    <select name="property_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        @foreach ($property as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->title }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                                <div class="form-group col-4">
                                    <label>Invoice Date <span class="text-danger">*</span></label>
                                    <input type="date" name="invoice_date" id="" class="form-control">


                                </div>
                                <div class="form-group col-4">
                                    <label>Booking Amount<span class="text-danger">*</span></label>
                                    <input type="number" name="booking_amount" id="" class="form-control">

                                </div>


                                <template x-if="prices.price">
                                    <div class="row">
                                        {{-- <p x-text=" prices.price"></p>
                                            <p x-text=" prices.area"></p> --}}

                                        {{-- <pre>{{ prices }}</pre> --}}
                                        <div class="form-group col-6">
                                            <label>Amount<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="price"
                                                :value="prices.price">


                                        </div>
                                        <div class="form-group col-6">
                                            <label>Area <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" :value="prices.area"
                                                name="area">


                                        </div>

                                    </div>
                                </template>



                                <div class="form-group col-6">
                                    <label>Payment Plan<span class="text-danger">*</span></label>
                                    <select name="installment_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        @foreach ($planp as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                {{-- <div class="form-group col-6">
                                    <label>Payment Type<span class="text-danger">*</span></label>
                                    <select name="client_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        @foreach ($planp as $clients)
                                            <option value="{{ $clients->id }}">{{ $clients->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div> --}}
                            </div>



                            {{-- <div class="form-group">
                                <label> Notes<span class="text-danger">*</span></label>
                                <textarea name="note" id="" cols="3" rows="2" style="width: 100%"></textarea>
                            </div> --}}
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <x-modals.popup />
    <x-modals.delete route="invoices.destroy" title="Invoice" /> --}}
    <script>
        function propertyPrices() {
            return {
                selectedPropertyId: '',
                prices: [],
                async fetchPrices() {
                    if (!this.selectedPropertyId) {
                        this.prices = [];
                        return;
                    }

                    try {
                        const response = await fetch(`/price/${this.selectedPropertyId}`);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const data = await response.json();

                        this.prices = data;
                        console.log(this.prices.price, this.prices.area);
                    } catch (error) {
                        console.error('Error fetching prices:', error);
                        this.prices = [];
                    }
                }
            };
        }
    </script>
@endsection
