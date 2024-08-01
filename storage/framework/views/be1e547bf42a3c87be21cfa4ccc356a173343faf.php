<?php echo e(Form::open(['url' => 'equipment/type'])); ?>

<div class="modal-body">

    <div class="form-group ">
        <?php echo e(Form::label('name', __('Equipment Type Name'), ['class' => 'form-label'])); ?>

        <?php echo e(Form::text('name', '', ['class' => 'form-control', 'required' => 'required'])); ?>

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

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH E:\laragon\www\construction\resources\views/equipment/equipmentTypeCreate.blade.php ENDPATH**/ ?>