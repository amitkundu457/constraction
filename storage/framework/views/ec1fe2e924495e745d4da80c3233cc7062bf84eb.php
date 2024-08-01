

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Verification Method')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('equipments.index')); ?>"><?php echo e(__('Equipment')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Verification')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Equipment</th>
                            
                            <th>Manufacturer</th>
                            <th>Verification Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $quals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>
                                <td><?php echo e($qual->equipment->name); ?></td>
                                
                                <td><?php echo e($qual->equipment->equipmentManufacturer->name); ?>

                                </td>
                                <td>
                                    <?php echo e($qual->verification_method); ?></td>
                                </td>


                                
                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($qual->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-<?php echo e($qual->id); ?>"
                                            data-id="<?php echo e($qual->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($qual->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="<?php echo e(route('equipment.quality.delete', $qual->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('delete'); ?>
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" data-dismiss="modal"
                                                                        class="btn btn-danger cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($qual->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Verification Method</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('equipment.quality.update', $qual->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_id" id="" required>
                                                                    <option value="">--Select Equipment--</option>
                                                                    <?php $__currentLoopData = $eqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($eqp->id); ?>" <?php if($qual->equipment_id == $eqp->id): echo 'selected'; endif; ?>><?php echo e($eqp->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Verification Method <span class="text-danger">*</span></label>
                                                                <input type="text" name="verification_method" id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($qual->verification_method); ?>" placeholder="">
                                                            </div>
                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Acceptance Criteria <span class="text-danger">*</span></label>
                                                            <textarea name="acceptance_criteria" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%" required><?php echo e($qual->acceptance_criteria); ?></textarea>
                                                        </div>
                                                        <div class="submit-section">
                                                            <button type="submit"
                                                                class="btn btn-primary submit-btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Verification Method</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('equipment.quality.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_id" id="" required>
                                        <option value="">--Select Equipment--</option>
                                        <?php $__currentLoopData = $eqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($eqp->id); ?>"><?php echo e($eqp->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Verification Method <span class="text-danger">*</span></label>
                                    <input type="text" name="verification_method" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('verification_method')); ?>" placeholder="">
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Acceptance Criteria <span class="text-danger">*</span></label>
                                <textarea name="acceptance_criteria" id="" class="form-control" cols="3" rows="2"
                                    style="width: 100%" required></textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/equipment/qualitycontrol.blade.php ENDPATH**/ ?>