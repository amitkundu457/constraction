

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Register Equipment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Register Equipment')); ?></li>
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
                            <th>#</th>
                            <th>Site Name</th>
                            <th>Location</th>
                            <th>Equipment Name</th>
                            <th>Quantity</th>
                            <th>Register Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $regeqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $regeqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>
                                <td><?php echo e($regeqp->site->name); ?></td>
                                <td><?php echo e($regeqp->location->name); ?>

                                <td><?php echo e($regeqp->equipment->name); ?>

                                </td>
                                <td><?php echo e($regeqp->quantity); ?></td>
                                <td>
                                    <?php echo e(Carbon\Carbon::parse($regeqp->date)->format('d M,Y')); ?>

                                </td>


                                
                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($regeqp->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-<?php echo e($regeqp->id); ?>"
                                            data-id="<?php echo e($regeqp->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($regeqp->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="<?php echo e(route('equipment.register.delete', $regeqp->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($regeqp->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Registered Equipment</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('equipment.register.update', $regeqp->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Equipment <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_id"
                                                                    id="" required>
                                                                    <option value="">Select Equipment</option>
                                                                    <?php $__currentLoopData = $eqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($eqp->id); ?>" <?php if($regeqp->equipment_id == $eqp->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($eqp->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Project <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="project_id"
                                                                    id="" required>
                                                                    <option value="">Select Project</option>
                                                                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($project->id); ?>" <?php if($regeqp->project_id == $project->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($project->project_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Site <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="warehouse_id"
                                                                    id="" required>
                                                                    <option value="">Select Site</option>
                                                                    <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($item->id); ?>" <?php if($regeqp->warehouse_id == $item->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($item->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Location <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vender_id" id=""
                                                                    required>
                                                                    <option value="">Select Location</option>
                                                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($item->id); ?>" <?php if($regeqp->vender_id == $item->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($item->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Quantity<span class="text-danger">*</span></label>
                                                                <input type="number" name="quantity" min="1"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($regeqp->quantity); ?>" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Registered Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="date" id="edit_checkin"
                                                                    class="form-control" required value="<?php echo e($regeqp->date); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Description</label>
                                                            <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%"><?php echo e($regeqp->description); ?></textarea>
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
                        <h5 class="modal-title">Register Equipments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('equipment.register.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Equipment <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_id" id="" required>
                                        <option value="">Select Equipment</option>
                                        <?php $__currentLoopData = $eqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($eqp->id); ?>"><?php echo e($eqp->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Project <span class="text-danger">*</span></label>
                                    <select class="form-control" name="project_id" id="" required>
                                        <option value="">Select Project</option>
                                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($project->id); ?>">
                                                <?php echo e($project->project_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Site <span class="text-danger">*</span></label>
                                    <select class="form-control" name="warehouse_id" id="" required>
                                        <option value="">Select Site</option>
                                        <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>">
                                                <?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Location <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vender_id" id="" required>
                                        <option value="">Select Location</option>
                                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>">
                                                <?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Quantity<span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" min="1" id="edit_checkin"
                                        class="form-control" required value="<?php echo e(old('quantity')); ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Registered Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Description</label>
                                <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                    style="width: 100%"></textarea>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/equipment/registerEquipment.blade.php ENDPATH**/ ?>