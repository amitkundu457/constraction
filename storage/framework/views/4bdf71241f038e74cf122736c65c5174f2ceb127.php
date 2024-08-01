

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Equipment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Equipment')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('equipment.register.index')); ?>" class="btn btn-sm btn-warning"  data-bs-toggle="tooltip" title="<?php echo e(__('Assign')); ?>" >
            <i class="ti ti-paperclip"></i>
        </a>
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
                            <th>Name</th>
                            <th>Type</th>
                            <th>Manufacturer</th>
                            <th>Quantity</th>
                            <th>Purchase Price</th>
                            <th>Purchase Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>
                                <td><?php echo e($equipment->name); ?></td>
                                <td><?php echo e($equipment->equipmentType->name); ?>

                                <td><?php echo e($equipment->equipmentManufacturer->name); ?>

                                </td>
                                <td><?php echo e($equipment->quantity); ?></td>
                                <td>

                                    &#8377;<?php echo e(number_format($equipment->purchase_price)); ?>

                                </td>


                                <td><?php echo e(Carbon\Carbon::parse($equipment->purchase_date)->format('d M,Y')); ?></td>
                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($equipment->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-<?php echo e($equipment->id); ?>"
                                            data-id="<?php echo e($equipment->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($equipment->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="<?php echo e(route('equipment.delete', $equipment->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($equipment->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit equipment</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('equipment.update', $equipment->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($equipment->name); ?>" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_type_id" id=""
                                                                    required>
                                                                    <option value="">Select Equipment Type</option>
                                                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($type->id); ?>"
                                                                            <?php if($equipment->equipment_type_id == $type->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($type->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Quantity<span class="text-danger">*</span></label>
                                                                <input type="number" name="quantity" min="1"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($equipment->quantity); ?>" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Price<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="purchase_price" min="1"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($equipment->purchase_price); ?>"
                                                                    placeholder="">
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label> Model Number</label>
                                                                <input class="form-control" type="text"
                                                                    name="model_number" id=""
                                                                    placeholder="e.g GSB 18V-55"
                                                                    value="<?php echo e($equipment->model_number); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Manufacturer <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="equipment_manufacturer_id"
                                                                    id="" required>
                                                                    <option value="">Select Manufacturer
                                                                    </option>
                                                                    <?php $__currentLoopData = $manufacs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($item->id); ?>"
                                                                            <?php if($equipment->equipment_manufacturer_id == $item->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($item->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Purchase Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="purchase_date"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($equipment->purchase_date); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label> Status <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="status"
                                                                    id="" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="0" <?php if(!$equipment->status): echo 'selected'; endif; ?>>
                                                                        Maintainance</option>
                                                                    <option value="1" <?php if($equipment->status): echo 'selected'; endif; ?>>
                                                                        Active</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label> Description</label>
                                                            <textarea name="description" id="" class="form-control" cols="3" rows="2"
                                                                style="width: 100%"><?php echo e($equipment->description); ?></textarea>
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
                        <h5 class="modal-title">Add Equipments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('equipment.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('name')); ?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_type_id" id="" required>
                                        <option value="">Select Equipment Type</option>
                                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
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
                                    <label> Purchase Price<span class="text-danger">*</span></label>
                                    <input type="number" name="purchase_price" min="1" id="edit_checkin"
                                        class="form-control" required value="<?php echo e(old('purchase_price')); ?>"
                                        placeholder="">
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label> Model Number</label>
                                    <input class="form-control" type="text" name="model_number" id=""
                                        placeholder="e.g GSB 18V-55">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Manufacturer <span class="text-danger">*</span></label>
                                    <select class="form-control" name="equipment_manufacturer_id"
                                        id="" required>
                                        <option value="">Select Equipment Type
                                        </option>
                                        <?php $__currentLoopData = $manufacs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>">
                                                <?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Purchase Date <span class="text-danger">*</span></label>
                                    <input type="date" name="purchase_date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="" required>
                                        <option value="">Select Status</option>
                                        <option value="0">Maintainance</option>
                                        <option value="1">Active</option>
                                    </select>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/equipment/index.blade.php ENDPATH**/ ?>