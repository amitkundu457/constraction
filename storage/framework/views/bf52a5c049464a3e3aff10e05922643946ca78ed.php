

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Vehicles')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Vehicle')); ?></li>
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
                            <th>Type</th>
                            <th>Code</th>
                            <th>Number</th>
                            <th>Fuel Type</th>
                            <th>Purchased</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>

                                <td><?php echo e($vehicle->vehicleType->name); ?></td>
                                <td><?php echo e($vehicle->code); ?></td>
                                <td><?php echo e($vehicle->number); ?></td>
                                <td>
                                    <?php if($vehicle->fuel_type == 0): ?>
                                        <?php echo e(__('Diesel')); ?>

                                    <?php elseif($vehicle->fuel_type == 1): ?>
                                        <?php echo e(__('CNG')); ?>

                                    <?php elseif($vehicle->fuel_type == 2): ?>
                                        <?php echo e(__('Petrol')); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($vehicle->status == 0): ?>
                                        <span class="badge badge-danger text-danger">Sold</span>
                                    <?php elseif($vehicle->status == 1): ?>
                                        <span class="badge badge-secondary text-secondary">Under Maintainance</span>
                                    <?php elseif($vehicle->status == 2): ?>
                                        <span class="badge badge-primary text-primary">Active</span>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo e(Carbon\Carbon::parse($vehicle->purchase_date)->format('d M,Y')); ?></td>
                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($vehicle->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete_modal-<?php echo e($vehicle->id); ?>"
                                            data-id="<?php echo e($vehicle->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($vehicle->id); ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete this record?</h5>
                                                        
                                                    </div>
                                                    <form action="<?php echo e(route('vehicle.delete', $vehicle->id)); ?>" method="post">
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($vehicle->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Vehicle</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('vehicle.update',$vehicle->id)); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class="form-group ">
                                                            <label> Vehicle Type <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="vehicle_type_id" required
                                                                id="">
                                                                <option value="">Select Vehicle Type</option>
                                                                <?php $__currentLoopData = $vehicleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($type->id); ?>"
                                                                        <?php if($vehicle->vehicle_type_id == $type->id): echo 'selected'; endif; ?>>
                                                                        <?php echo e($type->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Vehicle Code <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="code" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($vehicle->code); ?>" placeholder="e.g. VC457">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Vehicle Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="number" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($vehicle->number); ?>"
                                                                    placeholder="e.g. WBXXXXX">
                                                            </div>

                                                        </div>
                                                        

                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Date<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="date"
                                                                    name="purchase_date" id="" required
                                                                    value="<?php echo e($vehicle->purchase_date); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Amount<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="number"
                                                                    name="purchase_amount" id="" required
                                                                    value="<?php echo e($vehicle->purchase_amount); ?>">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Fuel Type<span class="text-danger">*</span></label>
                                                                <select class="form-control" name="fuel_type"
                                                                    id="" required>
                                                                    <option value="">Select Fuel Type</option>
                                                                    <option value="0" <?php if($vehicle->fuel_type == 0): echo 'selected'; endif; ?>>
                                                                        Diesel</option>
                                                                    <option value="1" <?php if($vehicle->fuel_type == 1): echo 'selected'; endif; ?>>CNG
                                                                    </option>
                                                                    <option value="2" <?php if($vehicle->fuel_type == 2): echo 'selected'; endif; ?>>
                                                                        Petrol</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> KMPL <span class="text-danger">*</span></label>
                                                                <input type="number" name="kmpl" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($vehicle->kmpl); ?>">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Start Meter Reading <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="start_meter_reading"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($vehicle->start_meter_reading); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Status <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="status"
                                                                    id="" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="0" <?php if($vehicle->status == 0): echo 'selected'; endif; ?>>
                                                                        Sold</option>
                                                                    <option value="1" <?php if($vehicle->status == 1): echo 'selected'; endif; ?>>
                                                                        Under Maintainance</option>
                                                                    <option value="2" <?php if($vehicle->status == 2): echo 'selected'; endif; ?>>
                                                                        Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="notes" id="" class="form-control" cols="3" rows="2" style="width: 100%"><?php echo e($vehicle->notes); ?></textarea>
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
                        <h5 class="modal-title">Add Vehicle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('vehicle.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group ">
                                <label> Vehicle Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="vehicle_type_id" id="" required>
                                    <option value="">Select Vehicle Type</option>
                                    <?php $__currentLoopData = $vehicleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Vehicle Code <span class="text-danger">*</span></label>
                                    <input type="text" name="code" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('code')); ?>" placeholder="e.g. VC457">
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Vehicle Number <span class="text-danger">*</span></label>
                                    <input type="text" name="number" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('number')); ?>" placeholder="e.g. WBXXXXX">
                                </div>

                            </div>
                            

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label> Purchase Date<span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" name="purchase_date" id=""
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Purchase Amount<span class="text-danger">*</span></label>
                                    <input class="form-control" type="number" name="purchase_amount" id=""
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Fuel <span class="text-danger">*</span></label>
                                    <select class="form-control" name="fuel_type" id="" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="0">Diesel</option>
                                        <option value="1">CNG</option>
                                        <option value="2">Petrol</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> KMPL <span class="text-danger">*</span></label>
                                    <input type="number" name="kmpl" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Start Meter Reading <span class="text-danger">*</span></label>
                                    <input type="number" name="start_meter_reading" id="edit_checkin"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="" required>
                                        <option value="">Select Status</option>
                                        <option value="0">Sold</option>
                                        <option value="1">Under Maintainance</option>
                                        <option value="2">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Notes</label>
                                <textarea name="notes" id="" class="form-control" cols="3" rows="2" style="width: 100%"></textarea>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/fleet/index.blade.php ENDPATH**/ ?>