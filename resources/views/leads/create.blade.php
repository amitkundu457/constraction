{{ Form::open(['url' => 'leads']) }}
<div class="modal-body">
    {{-- start for ai module --}}
    @php
        $plan = \App\Models\Utility::getChatGPTSettings();
    @endphp
    @if ($plan->chatgpt == 1)
        {{-- <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="{{ route('generate',['lead']) }}"
           data-bs-placement="top" data-title="{{ __('Generate content with AI') }}">
            <i class="fas fa-robot"></i> <span>{{__('Generate with AI')}}</span>
        </a>
    </div> --}}
    @endif
    {{-- end for ai module --}}
    <div class="row" x-data="{ type: null, ltype: null }">
        {{-- <div class="col-6 form-group">
            {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
            {{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div> --}}
        <div class="col-6 form-group">
            {{ Form::label('name', __('Client Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }}
            {{ Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('source_id', __('Source'), ['class' => 'form-label']) }}
            <select name="source_id" id="" class="form-control"
                x-on:change="type = $event.target.options[$event.target.selectedIndex].dataset.title">
                <option value="">--Select A Source--</option>
                @foreach ($sources as $source)
                    <option value="{{ $source->id }}" data-title="{{ strtolower($source->name) }}">
                        {{ $source->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 form-group" x-cloak x-show="type === 'agent'">
            {{ Form::label('agents_id', __('Agent'), ['class' => 'form-label']) }}
            <select name="agent_id" id="" class="form-control">
                <option value="">-- Select A Agent</option>
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}" >{{ $agent->name }}</option>
            @endforeach
        </select>
            @if (count($agents) == 1)
                <div class="text-muted text-xs">
                    {{ __('Please create new agent') }} <a href="{{ route('agent.index') }}">{{ __('here') }}</a>.
                </div>
            @endif
        </div>
        <div class="col-6 form-group" x-cloak x-show="type === 'website' ||type === 'websites'">
            {{ Form::label('link', __('Website link'), ['class' => 'form-label']) }}
            <input type="text" name="link" class="form-control" >
        </div>
        <div class="col-6 form-group" x-cloak x-show="type === 'social media'">
            {{ Form::label('smedia', __('Social Media Names'), ['class' => 'form-label']) }}
           <input type="text" name="smedia" class="form-control" >
        </div>
        <div class="col-6 form-group">
            {{ Form::label('source_id', __('Lead For'), ['class' => 'form-label']) }}
            <select name="lead_for" id="" class="form-control"
                x-on:change="ltype = $event.target.options[$event.target.selectedIndex].dataset.title">
                <option value="">--Select An Option--</option>
                <option value="plot" data-title="plot">Plot</option>
                <option value="property" data-title="property">Property</option>

            </select>
        </div>
        <div class="col-6 form-group" x-cloak x-show="ltype === 'property'">
            {{ Form::label('source_id', __('Property Name'), ['class' => 'form-label']) }}
            <select name="property_id" id="" class="form-control">
                <option value="property_id">--Select A Property--</option>
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 form-group" x-cloak x-show="ltype === 'plot'">
            {{ Form::label('source_id', __('Plot'), ['class' => 'form-label']) }}
            <select name="plot_id" id="" class="form-control">
                <option value="">--Select A Plot--</option>
                @foreach ($plots as $plot)
                    <option value="{{ $plot->id }}">{{ $plot->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 form-group">
            {{ Form::label('followup', __('Follow Up'), ['class' => 'form-label']) }}
            {{ Form::date('followup', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('stage', __('Lead Stage'), ['class' => 'form-label']) }}
            <select name="status" id="" class="form-control" required>
                <option value="">--Select Lead Stage--</option>
                @foreach ($stages as $stage)
                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 form-group">
            {{ Form::label('status', __('Lead Status'), ['class' => 'form-label']) }}
            <select name="stage" id="status" class="form-control" required>
                <option value="">--Select Lead Status--</option>
                @foreach ($status as $stat)
                    <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 form-group">
            {{ Form::label('Comments', __('Comment / Remarks'), ['class' => 'form-label']) }}
            <textarea required name="subject" id="" cols="30" rows="8" class="form-control"></textarea>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
