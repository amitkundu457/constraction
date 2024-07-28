<?php echo e(Form::open(['url' => 'vender', 'method' => 'post'])); ?>

<div class="modal-body" x-data="clientDetails()">

    <h6 class="sub-title"><?php echo e(__('Basic Info')); ?></h6>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('Location name', __('Location name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required'])); ?>


            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="">Phone No</label>
                <input type="number" class="form-control" name="contact">

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <label for="">Contractor </label>
            <select name="client_id" id="" class="form-control"
                @change="fetchClientDetails($event.target.value)">
                <?php
                    $clients = App\Models\User::where('type', 'client')->get();

                ?>
                <option value="">Select Client name</option>
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" :value="client && client.email" readonly>

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_zip', __('Zip Code'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('billing_zip', null, ['class' => 'form-control'])); ?>


            </div>
        </div>
        

        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label for="">Budget</label>
                <input type="text" class="form-control" name="email" :value="client && client.value" readonly>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('billing_address', __('Address'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::textarea('billing_address', null, ['class' => 'form-control', 'rows' => 3])); ?>

            </div>
        </div>


        

    </div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
    </div>
    <?php echo e(Form::close()); ?>

<?php /**PATH E:\laragon\www\construction\resources\views/vender/create.blade.php ENDPATH**/ ?>