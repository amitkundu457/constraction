<?php echo e(Form::open(['route' => 'plot.owner.store', 'method' => 'post','enctype'=>'multipart/form-data'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

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
        <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('phone', __('Phone'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
                <?php echo e(Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone'), 'required' => 'required'])); ?>

                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-phone" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo e(Form::label('location', __('City'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
                <?php echo e(Form::text('location', null, ['class' => 'form-control', 'placeholder' => __('Enter City'), 'required' => 'required'])); ?>

                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-location" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('state', __('State'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
                <?php echo e(Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('Enter State'), 'required' => 'required'])); ?>

                <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-state" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('adhaar', __('Adhaar No'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
                <?php echo e(Form::text('adhaar', null, ['class' => 'form-control', 'placeholder' => __('Enter Adhaar No'), 'required' => 'required'])); ?>

                <?php $__errorArgs = ['adhaar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-adhaar" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('address', __('Address'), ['class' => 'form-label'])); ?> <span class="text-danger">*</span>
                <?php echo e(Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => __('Enter owner address'), 'required' => 'required', 'rows' => '2'])); ?>

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
        <div class="col-md-12">
            <div class=" row" x-data="{ files: 1 }">
                <label class="my-2" style="font-weight: 600"> Upload Documents <span
                        class="text-danger">*</span></label>
                <div class="flex align-items-center">
                    <button type="button" x-on:click="files += 1" class="btn btn-sm btn-primary">
                        <i class="ti ti-plus"></i>
                    </button>
                    <button x-show="files !== 1" type="button" x-on:click="files -= 1" class="btn btn-sm btn-danger">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(index,file) in files">
                                <tr>
                                    <td x-text="index"></td>
                                    <td>
                                        <input type="text" :name="`documents[${index}][name]`" class="form-control"
                                            placeholder="Enter document name">
                                    </td>
                                    <td>
                                        <select :name="`documents[${index}][type]`" id="" class="form-control"
                                            style="width: 100%">
                                            <option value=""> Select Type</option>
                                            <option value="image">Image</option>
                                            <option value="document">Document</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="file" :name="`documents[${index}][file]`" class="form-control">
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

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH E:\laragon\www\construction\resources\views/plot/createOwner.blade.php ENDPATH**/ ?>