{{ Form::open(['url' => 'leave', 'method' => 'post']) }}
<div class="modal-body">
    {{-- start for ai module --}}
    @php
        $plan = \App\Models\Utility::getChatGPTSettings();
    @endphp
    {{-- @if ($plan->chatgpt == 1)
            <div class="text-end">
                <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['leave']) }}"
                  data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
                    <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
                </a>
            </div>
        @endif --}}
    {{-- end for ai module --}}
    @if (\Auth::user()->type == 'company' || \Auth::user()->type == 'HR')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('employee_id', __('Employee'), ['class' => 'form-label']) }}
                    {{ Form::select('employee_id', $employees, null, ['class' => 'form-control select', 'id' => 'employee_id', 'placeholder' => __('Select Employee')]) }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('leave_type_id', __('Leave Type'), ['class' => 'form-label']) }}
                <select name="leave_type_id" id="leave_type_id" class="form-control select">
                    <option value="">{{ __('Select Leave Type') }}</option>
                    @foreach ($leavetypes as $leave)
                        <option value="{{ $leave->id }}">{{ $leave->title }} (<p class="float-right pr-5">
                                {{ $leave->days }}</p>)</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                {{ Form::date('start_date', null, ['class' => 'form-control']) }}


            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                {{ Form::date('end_date', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div x-data="{ showInput: false }">
                <label>
                    <input type="checkbox" x-model="showInput"> Half Day
                </label>
                <div x-show="showInput">
                    <div class="form-group">
                        {{ Form::label('hour', __('Hours'), ['class' => 'form-label']) }}
                        {{ Form::text('leave_hour', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('leave_reason', __('Leave Reason'), ['class' => 'form-label']) }}
                {{ Form::textarea('leave_reason', null, ['class' => 'form-control', 'placeholder' => __('Leave Reason')]) }}
            </div>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-md-12 text-end">
            <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm text-right"
                data-ajax-popup-over="true" id="grammarCheck" data-url="{{ route('grammar', ['grammar']) }}"
                data-bs-placement="top" data-title="{{ __('Grammar check with AI') }}">
                <i class="ti ti-rotate"></i> <span>{{ __('Grammar check with AI') }}</span>
            </a>
        </div> --}}
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('remark', __('Remark'), ['class' => 'form-label']) }}
                {{ Form::textarea('remark', null, ['class' => 'form-control grammer_textarea', 'placeholder' => __('Leave Remark')]) }}
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}
