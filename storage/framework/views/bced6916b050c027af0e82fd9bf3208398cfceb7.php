

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Retailers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Retailer')); ?></li>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Product Category</th>
                            <th>Area</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $retailers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>

                                <td><?php echo e($manu->name); ?></td>
                                <td><?php echo e($manu->email); ?></td>
                                <td><?php echo e($manu->phone); ?></td>
                                <td><?php echo e($manu->category->name); ?></td>
                                <td><?php echo e($manu->area->name); ?></td>
                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($manu->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-<?php echo e($manu->id); ?>"
                                            data-id="<?php echo e($manu->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($manu->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>
                                                    </div>
                                                    <form action="<?php echo e(route('food.retailer.destroy', $manu->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($manu->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Retailer</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('food.retailer.update',$manu->id)); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($manu->name); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Email <span class="text-danger">*</span></label>
                                                                <input type="email" name="email" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($manu->email); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Phone <span class="text-danger">*</span></label>
                                                                <input type="tel" name="phone" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($manu->phone); ?>">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>City <span class="text-danger">*</span></label>
                                                                <input type="text" name="city" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($manu->city); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label>State <span class="text-danger">*</span></label>
                                                                <input type="text" name="state" id="edit_checkin"
                                                                    class="form-control" required
                                                                    value="<?php echo e($manu->state); ?>">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Area <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="food_area_id"
                                                                    id="" required>
                                                                    <option value="">Select category</option>
                                                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($item->id); ?>" <?php if($manu->food_area_id == $item->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($item->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Category <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="food_category_id"
                                                                    id="" required>
                                                                    <option value="">Select category</option>
                                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($category->id); ?>" <?php if($manu->food_category_id == $category->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($category->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address <span class="text-danger">*</span></label>
                                                            <textarea name="address" id="" class="form-control" cols="3" rows="2" style="width: 100%"><?php echo e($manu->address); ?></textarea>
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
                        <h5 class="modal-title">Add New Retilaer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('food.retailer.store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('name')); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('price')); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('price')); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('price')); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>State <span class="text-danger">*</span></label>
                                    <input type="text" name="state" id="edit_checkin" class="form-control" required
                                        value="<?php echo e(old('price')); ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Area <span class="text-danger">*</span></label>
                                    <select class="form-control" name="food_area_id" id="" required>
                                        <option value="">Select area</option>
                                        <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="food_category_id" id="" required>
                                        <option value="">Select category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="" class="form-control" cols="3" rows="2" style="width: 100%"></textarea>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/food/retailer.blade.php ENDPATH**/ ?>