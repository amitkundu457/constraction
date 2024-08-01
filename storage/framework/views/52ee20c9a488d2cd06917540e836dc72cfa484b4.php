<?php echo e(Form::model($warehouse, ['route' => ['warehouse.update', $warehouse->id], 'method' => 'PUT'])); ?>


<div class="modal-body">
    
    <?php
        $plan = \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
        
    <?php endif; ?>
    
    <div class="row">
        <div class="form-group col-md-12">

            <?php echo e(Form::label('name', __('Site Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <small class="invalid-name" role="alert">
                    <strong class="text-danger"><?php echo e($message); ?></strong>
                </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('address', __('Address'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city', __('City'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('city', null, ['class' => 'form-control'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city_zip', __('Zip Code'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('city_zip', null, ['class' => 'form-control'])); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Edit')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH E:\laragon\www\construction\resources\views/warehouse/edit.blade.php ENDPATH**/ ?>