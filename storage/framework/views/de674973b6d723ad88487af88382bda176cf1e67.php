<?php echo e(Form::open(['url' => 'leads'])); ?>

<div class="modal-body">
    
    <?php
        $plan = \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
        
    <?php endif; ?>
    
    <div class="row" x-data="{ type: null, ltype: null }">
        
        <div class="col-6 form-group">
            <?php echo e(Form::label('name', __('Client Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('phone', __('Phone'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('phone', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('source_id', __('Source'), ['class' => 'form-label'])); ?>

            <select name="source_id" id="" class="form-control"
                x-on:change="type = $event.target.options[$event.target.selectedIndex].dataset.title">
                <option value="">--Select A Source--</option>
                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($source->id); ?>" data-title="<?php echo e(strtolower($source->name)); ?>">
                        <?php echo e($source->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group" x-cloak x-show="type === 'agent'">
            <?php echo e(Form::label('agents_id', __('Agent'), ['class' => 'form-label'])); ?>

            <select name="" id="" class="form-control">
                <option value="">-- Select A Agent</option>
            <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($agent->id); ?>" ><?php echo e($agent->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
            <?php if(count($agents) == 1): ?>
                <div class="text-muted text-xs">
                    <?php echo e(__('Please create new agent')); ?> <a href="<?php echo e(route('agent.index')); ?>"><?php echo e(__('here')); ?></a>.
                </div>
            <?php endif; ?>
        </div>
        <div class="col-6 form-group" x-cloak x-show="type === 'website' ||type === 'websites'">
            <?php echo e(Form::label('link', __('Website link'), ['class' => 'form-label'])); ?>

            <input type="text" name="link" class="form-control" >
        </div>
        <div class="col-6 form-group" x-cloak x-show="type === 'social media'">
            <?php echo e(Form::label('smedia', __('Social Media Names'), ['class' => 'form-label'])); ?>

           <input type="text" name="smedia" class="form-control" >
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('source_id', __('Lead For'), ['class' => 'form-label'])); ?>

            <select name="lead_for" id="" class="form-control"
                x-on:change="ltype = $event.target.options[$event.target.selectedIndex].dataset.title">
                <option value="">--Select An Option--</option>
                <option value="plot" data-title="plot">Plot</option>
                <option value="property" data-title="property">Property</option>

            </select>
        </div>
        <div class="col-6 form-group" x-cloak x-show="ltype === 'property'">
            <?php echo e(Form::label('source_id', __('Property Name'), ['class' => 'form-label'])); ?>

            <select name="property_id" id="" class="form-control">
                <option value="property_id">--Select A Property--</option>
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($property->id); ?>"><?php echo e($property->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group" x-cloak x-show="ltype === 'plot'">
            <?php echo e(Form::label('source_id', __('Plot'), ['class' => 'form-label'])); ?>

            <select name="plot_id" id="" class="form-control">
                <option value="">--Select A Plot--</option>
                <?php $__currentLoopData = $plots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($plot->id); ?>"><?php echo e($plot->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('followup', __('Follow Up'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('followup', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('stage', __('Lead Stage'), ['class' => 'form-label'])); ?>

            <select name="status" id="" class="form-control" required>
                <option value="">--Select Lead Stage--</option>
                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($stage->id); ?>"><?php echo e($stage->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('status', __('Lead Status'), ['class' => 'form-label'])); ?>

            <select name="stage" id="status" class="form-control" required>
                <option value="">--Select Lead Status--</option>
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($stat->id); ?>"><?php echo e($stat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-12 form-group">
            <?php echo e(Form::label('Comments', __('Comment / Remarks'), ['class' => 'form-label'])); ?>

            <textarea required name="subject" id="" cols="30" rows="8" class="form-control"></textarea>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH E:\laragon\www\construction\resources\views/leads/edit.blade.php ENDPATH**/ ?>