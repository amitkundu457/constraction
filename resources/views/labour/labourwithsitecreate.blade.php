{{ Form::open(['route' => 'laboursitecreate', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body" x-data="filter()">
    <div class="row">
        <div  class="row">
            <!-- Site Selection for Projects -->
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('site_id', __('Site'), ['class' => 'form-label']) }} <span
                        class="text-danger">*</span>
                    <select name="site_id" id="site_id" class="form-control" x-on:change="projects($event.target.value)" required>
                        <option value="">-- Select Site --</option>
                        @foreach ($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                    @error('site_id')
                        <small class="invalid-site_id" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>

            <!-- Project Selection -->
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('project_id', __('Project'), ['class' => 'form-label']) }} <span
                        class="text-danger">*</span>
                    <select name="project_id" id="project_id" class="form-control" required>
                        <option value="">-- Select Project --</option>
                        <template x-for="project in projects" :key="project.id">
                            <option :value="project.id" x-text="project.project_name"></option>
                        </template>
                    </select>
                    @error('project_id')
                        <small class="invalid-project_id" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Group Selection for Labours -->
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('labour_group_id', __('Group'), ['class' => 'form-label']) }} <span
                        class="text-danger">*</span>
                    <select name="labour_group_id" id="labour_group_id" x-on:change="labours($event.target.value)" class="form-control"
                        required>
                        <option value="">-- Select Group --</option>
                        @foreach ($grps as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach
                    </select>
                    @error('labour_group_id')
                        <small class="invalid-labour_group_id" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>

            <!-- Labor Group Selection -->
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('labor_id', __('Labor Group'), ['class' => 'form-label']) }} <span
                        class="text-danger">*</span>
                    <select name="labour_id" id="labor_id" class="form-control" required>
                        {{-- <option value="">-- Select Labor Group --</option> --}}
                        <template x-for="labor in labours" :key="labor.id">
                            <option :value="labor.id" x-text="labor.name"></option>
                        </template>
                    </select>
                    @error('labor_id')
                        <small class="invalid-labor_id" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
        </div>




    </div>

</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>

{{ Form::close() }}
