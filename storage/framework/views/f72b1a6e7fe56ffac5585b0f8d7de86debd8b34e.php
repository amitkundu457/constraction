<?php echo e(Form::open(['url' => 'account-assets'])); ?>

<div class="modal-body">
    
    <?php
        $plan = \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
        
    <?php endif; ?>
    
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('employee_id', __('Employee'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('employee_id[]', $employee, null, ['class' => 'form-control select2', 'id' => 'choices-multiple1', 'multiple'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', '', ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount', __('Amount'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('amount', '', ['class' => 'form-control', 'required' => 'required', 'step' => '0.01'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('purchase_date', __('Purchase Date'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('purchase_date', '', ['class' => 'form-control '])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('supported_date', __('Supported Date'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::date('supported_date', '', ['class' => 'form-control '])); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('description', '', ['class' => 'form-control', 'rows' => 3])); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH E:\laragon\www\construction\resources\views/assets/create.blade.php ENDPATH**/ ?>