

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Income & Expenses')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Income & Expenses')); ?></li>
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
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>

                                <td><?php echo e($expense->vehicle->vehicleType->name . ' / ' . $expense->vehicle->number . ' - ' . $expense->vehicle->code); ?>

                                </td>
                                <td><?php echo e(Carbon\Carbon::parse($expense->date)->format('d M, Y')); ?></td>
                                <td style="width: 25%"><?php echo e($expense->description); ?></td>
                                <td>&#8377; <?php echo e(number_format($expense->amount)); ?></td>
                                <td>
                                    <?php if($expense->type == 'income'): ?>
                                        <span class="badge bg-info font-medium"
                                            style="font-size: 13px;"><?php echo e(ucfirst($expense->type)); ?> <i class="ti ti-arrow-up"></i></span>
                                            
                                    <?php elseif($expense->type == 'expense'): ?>
                                        <span class="badge bg-danger font-medium"
                                            style="font-size: 13px;"><?php echo e(ucfirst($expense->type)); ?> <i class="ti ti-arrow-down"></i></span>
                                    <?php endif; ?>
                                </td>

                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($expense->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary text-light"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-<?php echo e($expense->id); ?>"
                                            data-id="<?php echo e($expense->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($expense->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="<?php echo e(route('vehicle.expense.delete', $expense->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($expense->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Booking</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('vehicle.expense.update', $expense->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Vehicle <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vehicle_id"
                                                                    id="" required>
                                                                    <option value="">-- Select Vehicle --</option>
                                                                    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($vehicle->id); ?>"
                                                                            <?php if($expense->vehicle_id == $vehicle->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($vehicle->vehicleType->name . ' / ' . $vehicle->number . ' - ' . $vehicle->code); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="type" id=""
                                                                    required>
                                                                    <option value="">-- Select Type --</option>
                                                                    <option value="income" <?php if($expense->type == 'income'): echo 'selected'; endif; ?>>
                                                                        Income</option>
                                                                    <option value="expense" <?php if($expense->type == 'expense'): echo 'selected'; endif; ?>>
                                                                        Expense</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Date <span class="text-danger">*</span></label>
                                                                <input type="date" name="date" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($expense->date); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Amount <span class="text-danger">*</span></label>
                                                                <input type="number" name="amount" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($expense->amount); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label>Description <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class="form-control" name="description" id="" rows="3"><?php echo e($expense->description); ?></textarea>
                                                            </div>
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
                        <h5 class="modal-title">Add expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('vehicle.expense.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Vehicle <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vehicle_id" id="" required>
                                        <option value="">-- Select Vehicle --</option>
                                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vehicle->id); ?>">
                                                <?php echo e($vehicle->vehicleType->name . ' / ' . $vehicle->number . ' - ' . $vehicle->code); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="type" id="" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="" rows="3"></textarea>
                                </div>
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
        // $(document).ready(function() {
        //     $('.deletebtn').on('click', function() {
        //         var id = $(this).data('id');
        //         $('#delete_id').val(id);
        //     });
        // });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/fleet/expenses.blade.php ENDPATH**/ ?>