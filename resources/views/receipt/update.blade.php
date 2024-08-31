@extends('layouts.admin')
@section('page-title')
    {{ __('Receipt Create') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('receipt.index') }}">{{ __('Receipt') }}</a></li>
    <li class="breadcrumb-item">{{ __('Update') }}</li>
@endsection
@section('content')
    {{ Form::open(['route' => ['receipt.edit',$rc->id],'method'=>'put']) }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', __('Receipt No.'), ['class' => 'form-label']) }}
                            {{ Form::text('number', $rc->number, ['class' => 'form-control', 'required' => 'required', 'readonly']) }}
                            @error('name')
                                <small class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('name', __('Receipt Date'), ['class' => 'form-label']) }}
                            {{ Form::date('date', $rc->date, ['class' => 'form-control', 'required' => 'required']) }}
                            @error('name')
                                <small class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', __('Select Project'), ['class' => 'form-label']) }}
                            <select name="project_id" id="" class="form-control">
                                <option value="">Select Project</option>
                                @foreach ($projs as $proj)
                                    <option value="{{ $proj->id }}" @selected($proj->id == $rc->project_id)>{{ $proj->project_name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <small class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('name', __('Select Site'), ['class' => 'form-label']) }}
                            <select name="vender_id" id="" class="form-control">
                                <option value="">Select Site</option>
                                @foreach ($venders as $vend)
                                    <option value="{{ $vend->id }}" @selected($vend->id == $rc->vender_id)>{{ $vend->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <small class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', __('Select Supplier'), ['class' => 'form-label']) }}
                            <select name="company_id" id="" class="form-control">
                                <option value="">Select Supplier</option>
                                @foreach ($company as $cmpp)
                                    <option value="{{ $cmpp->id }}" @selected($cmpp->id == $rc->company_id)>{{ $cmpp->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <small class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                    </div>
                    <div class="row" x-data="{ rows: [], addRow() { this.rows.push({ id: Date.now() }); }, deleteRow(index) { this.rows.splice(index, 1); } }" x-init="rows = {{ json_encode($rc->materials) }}; rows.forEach(row => row.id = Date.now());">
                        <div class="col-12">
                            <div class="py-3">
                                <button type="button" class="btn btn-sm bg-primary text-light" x-on:click="addRow"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(row, index) in rows" :key="index">
                                            <tr x-data="{qty:row.quantity || 0,p:row.price || 0}">
                                                <td x-text="index + 1"></td>
                                                <td>
                                                    <select required :name="`items[${index}][material_id]`" id="" class="form-control">
                                                        <option value="">--Select Material --</option>
                                                        @foreach ($mats as $item)
                                                            <option value="{{ $item->id }}" :selected="row.material_id && row.material_id === '{{ json_encode($item->id) }}'">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input required :name="`items[${index}][quantity]`" x-on:input="qty = $event.target.value" type="number" :value="row.quantity || 0" class="form-control"></td>
                                                <td><input required :name="`items[${index}][price]`" x-on:input="p = $event.target.value" type="number" :value="row.price || 0" class="form-control"></td>
                                                <td >&#8377; <span x-text="qty * p"></span></td>
                                                <td x-show="index !== 0">
                                                    <button type="button" class="btn btn-sm bg-danger text-light"
                                                        x-on:click="deleteRow(index)"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
    </div>
    {{ Form::close() }}
@endsection
