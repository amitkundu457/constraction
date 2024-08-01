@extends('layouts.admin')

@section('page-title')
    {{ __('Service Report') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('equipments.index') }}">{{ __('Equipment') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('equipment.maintainance.index') }}">{{ __('Service') }}</a></li>
    <li class="breadcrumb-item">{{ __('Report') }}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        {{-- <a href="{{ route('equipment.register.index') }}" class="btn btn-sm btn-warning"  data-bs-toggle="tooltip" title="{{__('Assign')}}" >
            <i class="ti ti-paperclip"></i>
        </a> --}}
        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a> --}}
    </div>
@endsection


@section('content')
    <div class="my-5">


        <div class="d-flex justify-content-center align-items-center w-full pb-5">
            <h1 class="text-primary">SERVICE SCHEDULING REPORT</h1>
        </div>
        <div class="row mx-2 my-4">
            <div class="col-md-3">
                <h4 class="text-dark">Equipment</h4>
                <div class="my-2">
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Name : ' . $eqpm->equipment->name }}
                    </p>
                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Model : ' . $eqpm->equipment->model_number }}
                    </p>
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Type : ' . $eqpm->equipment->equipmentType->name }}
                    </p>
                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Manufacturer : ' . $eqpm->equipment->equipmentManufacturer->name }}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Verification Method</h4>
                <div class="">

                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Type : ' . $eqpm->quality->verification_method }}
                    </p>
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Criteria : ' . $eqpm->quality->acceptance_criteria }}
                    </p>

                </div>
            </div>
            <div class="col-md-3">
                <h4>Service Details</h4>
                <div class="my-2">

                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Frequency : ' . $eqpm->service_frequency_time . ' ' . ucfirst($eqpm->service_frequency_type) }}
                    </p>
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        {{ 'Criteria : ' . $eqpm->description }}
                    </p>

                </div>
            </div>
            <div class="col-md-3">
                <h4>Service Type</h4>
                <div>
                    <p class=" badge rounded-pill text-white px-2 {{ $eqpm->service_type == 1 ? 'bg-danger ' : 'bg-warning' }} "
                        style="font-weight: 500; font-size:12px;">
                        {{ $eqpm->service_type == 1 ? 'Maintainance' : 'Calibration' }}
                    </p>
                </div>
            </div>
        </div>
        <form action="{{ route('equipment.maintainance.review',$eqpm->id) }}" method="post" class="mx-2">
            @csrf
            @method('put')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="" class="form-label">Condition <span class="text-danger">*</span></label>
                    <select name="equipment_condition_id" id="" class="form-control" required>
                        <option value="">-- Select Condition --</option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}" @selected($eqpm && $eqpm->equipment_condition_id == $condition->id)>{{ $condition->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="form-label">Review Date <span class="text-danger">*</span></label>
                    <input type="date" name="review_date" id="" value="{{ $eqpm->review_date ?? '' }}" class="form-control" required>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-12">
                    <label for="" class="form-label">Review Report <span class="text-danger">*</span></label>
                    <textarea name="report" id="" cols="30" rows="5" class="form-control" required>{{ $eqpm->report ?? '' }}</textarea>
                </div>
            </div>
            <div>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>
    <script>
        // $(document).ready(function() {
        //     $('.deletebtn').on('click', function() {
        //         var id = $(this).data('id');
        //         $('#delete_id').val(id);
        //     });
        // });

        function loadquality() {
            return {
                quals: null,
                desc: null,
                getQuality(id) {
                    fetch(`/equipment/quality/${id}`).then((res) => res.json()).then((data) => this.quals = data.quality)
                }
            }
        }
    </script>
@endsection
