@extends('layouts.admin')
@section('page-title')
    {{ __('Supplier Report Create') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('purchase.index') }}">{{ __('Supplier Report') }}</a></li>
    <li class="breadcrumb-item">{{ __('Create') }}</li>
@endsection
@push('script-page')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function() {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    $('.select2').select2();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".amount");
                        var subTotal = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                        }
                        $('.subTotal').html(subTotal.toFixed(2));
                        $('.totalAmount').html(subTotal.toFixed(2));
                    }
                },
                ready: function(setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

        }

        $(document).on('change', '#vender', function() {
            $('#vender_detail').removeClass('d-none');
            $('#vender_detail').addClass('d-block');
            $('#vender-box').removeClass('d-block');
            $('#vender-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function(data) {
                    if (data != '') {
                        $('#vender_detail').html(data);
                    } else {
                        $('#vender-box').removeClass('d-none');
                        $('#vender-box').addClass('d-block');
                        $('#vender_detail').removeClass('d-block');
                        $('#vender_detail').addClass('d-none');
                    }
                },
            });
        });

        $(document).on('click', '#remove', function() {
            $('#vender-box').removeClass('d-none');
            $('#vender-box').addClass('d-block');
            $('#vender_detail').removeClass('d-block');
            $('#vender_detail').addClass('d-none');
        })


        $(document).on('change', '.item', function() {
            var iteams_id = $(this).val();
            var url = $(this).data('url');
            var el = $(this);

            $.ajax({
                url: url,
                type: 'POST',
                // headers: {
                //     'X-CSRF-TOKEN': $('#token').val()
                // },
                data: {
                    '_token': "{{ csrf_token() }}",
                    'product_id': iteams_id
                },
                cache: false,
                success: function(data) {
                    var item = JSON.parse(data);

                    $(el.parent().parent().find('.quantity')).val(1);
                    $(el.parent().parent().find('.price')).val(item.product.purchase_price);
                    $(el.parent().parent().parent().find('.pro_description')).val(item.product
                        .description);
                    console.log(el);
                    var taxes = '';
                    var tax = [];

                    var totalItemTaxRate = 0;
                    if (item.taxes == 0) {
                        taxes += '-';
                    } else {
                        for (var i = 0; i < item.taxes.length; i++) {

                            taxes += '<span class="badge bg-primary mt-1 mr-2">' + item.taxes[i].name +
                                ' ' + '(' + item.taxes[i].rate + '%)' + '</span>';
                            tax.push(item.taxes[i].id);
                            totalItemTaxRate += parseFloat(item.taxes[i].rate);

                        }
                    }
                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.product
                        .purchase_price * 1));

                    $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                    $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                    $(el.parent().parent().find('.taxes')).html(taxes);
                    $(el.parent().parent().find('.tax')).val(tax);
                    $(el.parent().parent().find('.unit')).html(item.unit);
                    $(el.parent().parent().find('.discount')).val(0);
                    $(el.parent().parent().find('.amount')).html(item.totalAmount);


                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));


                    var totalItemPrice = 0;
                    var priceInput = $('.price');
                    for (var j = 0; j < priceInput.length; j++) {
                        totalItemPrice += parseFloat(priceInput[j].value);
                    }

                    var totalItemTaxPrice = 0;
                    var itemTaxPriceInput = $('.itemTaxPrice');
                    for (var j = 0; j < itemTaxPriceInput.length; j++) {
                        totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                    }

                    $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                    $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice))
                        .toFixed(2));

                },
            });
        });

        $(document).on('keyup', '.quantity', function() {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            var discount = $(el.find('.discount')).val();
            if (discount.length <= 0) {
                discount = 0;
            }

            var totalItemPrice = (quantity * price) - discount;
            var amount = (totalItemPrice);


            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice) + parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));

        })

        $(document).on('keyup change', '.price', function() {
            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();

            var discount = $(el.find('.discount')).val();
            if (discount.length <= 0) {
                discount = 0;
            }
            var totalItemPrice = (quantity * price) - discount;

            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice) + parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));


        })

        $(document).on('keyup change', '.discount', function() {
            var el = $(this).parent().parent().parent();
            var discount = $(this).val();
            if (discount.length <= 0) {
                discount = 0;
            }

            var price = $(el.find('.price')).val();
            var quantity = $(el.find('.quantity')).val();
            var totalItemPrice = (quantity * price) - discount;


            var amount = (totalItemPrice);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));

            $(el.find('.amount')).html(parseFloat(itemTaxPrice) + parseFloat(amount));

            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemPrice = 0;
            var inputs_quantity = $(".quantity");

            var priceInput = $('.price');
            for (var j = 0; j < priceInput.length; j++) {
                totalItemPrice += (parseFloat(priceInput[j].value) * parseFloat(inputs_quantity[j].value));
            }

            var inputs = $(".amount");

            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }


            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }


            $('.subTotal').html(totalItemPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal)).toFixed(2));
            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));




        })
    </script>

    <script>
        $(document).on('click', '[data-repeater-delete]', function() {
            $(".price").change();
            $(".discount").change();
        });
    </script>
@endpush

@section('content')
    <div class="row">
        {{ Form::open(['route' => 'reports.suppliers.create', 'class' => 'w-100']) }}
        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="vender-box">
                                {{ Form::label('vender_id', __('Select Site'), ['class' => 'form-label']) }}
                                <select name="vender_id" id="" class="form-control">
                                    <option value="">-- Select Site --</option>
                                    @foreach ($venders as $vender)
                                        <option value="{{ $vender->id }}">
                                            {{ $vender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('report_date', __('Report Date'), ['class' => 'form-label']) }}
                                {{ Form::date('report_date', null, ['class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            {{-- <h5 class=" d-inline-block mb-4">{{ __('Product & Services') }}</h5> --}}
            <div class="card repeater">
                <div class="item-section py-2">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box me-2">
                                <a href="#" data-repeater-create="" class="btn btn-primary" data-bs-toggle="modal"
                                    data-target="#add-bank">
                                    <i class="ti ti-plus"></i> {{ __('Add item') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" id="sortable-table">
                            <thead>
                                <tr>
                                    <th>{{ __('Supplier') }}</th>
                                    <th>{{ __('Items') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Unit') }}</th>
                                    <th>{{ __('Price') }} </th>
                                    <th>{{ __('Discount') }}</th>
                                    <th>{{ __('Paid') }}</th>
                                    {{-- <th class="text-end">{{ __('Amount') }} <br><small
                                            class="text-danger font-weight-bold">{{ __('after tax & discount') }}</small>
                                    </th> --}}
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-list="items">
                                <tr data-repeater-item x-data="{quantity:0,price:0,discount:0,pa:0}">
                                    <td width="15%">
                                        <div class="form-group">
                                            <select name="company_id" id="" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @foreach ($company as $cmp)
                                                    <option value="{{ $cmp->id }}">{{ $cmp->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td width="15%">
                                        <div class="form-group">
                                            {{ Form::select('item', $product_services, '', ['class' => 'form-control select2 item', 'data-url' => route('purchase.product'), 'required' => 'required']) }}
                                        </div>
                                    </td>
                                    <td width="13%">
                                        <div class="form-group price-input input-group search-form">
                                            {{ Form::text('quantity', '0', ['x-on:input'=>'quantity = $event.target.value','class' => 'form-control quantity', 'required' => 'required', 'placeholder' => __('Qty'), 'required' => 'required']) }}

                                            {{-- <span class="unit input-group-text bg-transparent"></span> --}}
                                        </div>
                                    </td>
                                    <td width="15%">
                                        <div class="form-group">
                                            <select name="unit" id="" class="form-control">
                                                <option value="">Select Unit</option>
                                                <option value="0">KG</option>
                                                <option value="1">Pieces</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td width="13%">
                                        <div class="form-group price-input input-group search-form">
                                            {{ Form::text('price', '0', ['x-on:input'=>'price = $event.target.value','class' => 'form-control price', 'required' => 'required', 'placeholder' => __('Price'), 'required' => 'required']) }}
                                            {{-- <span
                                                class="input-group-text bg-transparent">{{ \Auth::user()->currencySymbol() }}</span> --}}
                                        </div>
                                    </td>
                                    <td width="13%">
                                        <div class="form-group price-input input-group search-form">
                                            {{ Form::text('discount', '0', ['x-on:input'=>'discount = $event.target.value','class' => 'form-control discount', 'required' => 'required', 'placeholder' => __('Discount')]) }}
                                            {{-- <span
                                                class="input-group-text bg-transparent">{{ \Auth::user()->currencySymbol() }}</span> --}}
                                        </div>
                                    </td>
                                    <td width="25%">
                                        <div class="form-group price-input input-group search-form">
                                            {{ Form::text('paid_amount', '0', ['x-on:input'=>'pa = $event.target.value','class' => 'form-control discount', 'required' => 'required', 'placeholder' => __('Paid Amount')]) }}
                                            {{-- <span
                                                class="input-group-text bg-transparent">{{ \Auth::user()->currencySymbol() }}</span> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            <div class="input-group">
                                                <div class="taxes"></div>
                                                {{ Form::hidden('tax', '', ['class' => 'form-control tax']) }}
                                                {{ Form::hidden('itemTaxPrice', '', ['class' => 'form-control itemTaxPrice']) }}
                                                {{ Form::hidden('itemTaxRate', '', ['class' => 'form-control itemTaxRate']) }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-end">
                                        <span x-text="price * quantity - discount - pa"></span>
                                    </td>
                                    <td>
                                        <a href="#" class="ti ti-trash text-white repeater-action-btn bg-danger ms-2"
                                            data-repeater-delete></a>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            {{ Form::textarea('description', null, ['class' => 'form-control pro_description', 'rows' => '2', 'placeholder' => __('Description')]) }}
                                        </div>
                                    </td>
                                    <td colspan="7"></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <input type="button" value="{{ __('Cancel') }}" onclick="location.href = '{{ route('purchase.index') }}';"
                class="btn btn-light">
            <input type="submit" value="{{ __('Save') }}" class="btn  btn-primary">
        </div>
        {{ Form::close() }}
    </div>
@endsection
