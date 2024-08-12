

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Property Type')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Property Type')); ?></li>
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
                            <th>Plot Name</th>
                            <th>Description</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($propertie->type_name); ?></td>
                                <td><?php echo e($propertie->plot($propertie->plot_id)->name); ?></td>
                                <td><?php echo e($propertie->note); ?></td>




                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-toggle="modal" data-target="#edit_modal-<?php echo e($propertie->id); ?>"
                                            data-id="<?php echo e($propertie->id); ?>" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil text-white"></i> </a>
                                        
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#delete_modal" data-id="<?php echo e($propertie->id); ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="edit_modal-<?php echo e($propertie->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Type <?php echo e($propertie->id); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(url('property-type-update', $propertie->id)); ?>"
                                                        method="post" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="<?php echo e($propertie->type_name); ?>" type="text"
                                                                name="type_name" id="edit_checkin" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label> Plot Details<span class="text-danger">*</span></label>
                                                            <select type="text" name="plot_id" id="edit_checkin" class="form-control">
                                                                <option value="">Select Plot</option>
                                                                <?php $__currentLoopData = $plots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($plot->id); ?>"><?php echo e($plot->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%"><?php echo e($propertie->note); ?></textarea>
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
                                    <div class="modal custom-modal fade" id="edit_modal-<?php echo e($propertie->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Type <?php echo e($propertie->id); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(url('property-type-update', $propertie->id)); ?>"
                                                        method="post" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="<?php echo e($propertie->type_name); ?>" type="text"
                                                                name="type_name" id="edit_checkin" class="form-control">
                                                        </div>



                                                        <div class="form-group">
                                                            <label> Notes<span class="text-danger">*</span></label>
                                                            <textarea name="note" id="" cols="3" rows="2" style="width: 100%"><?php echo e($propertie->note); ?></textarea>
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
                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        
                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="<?php echo e(url('property-type-delete', $propertie->id)); ?>"
                                                        method="get">
                                                        
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <button data-dismiss="modal"
                                                                        class="btn btn-primary cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $count++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-center">
                            
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Property Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(url('property-type-store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label> Title <span class="text-danger">*</span></label>
                                <input type="text" name="type_name" id="edit_checkin" class="form-control">
                            </div>

                            <div class="form-group">
                                <label> Plot Details<span class="text-danger">*</span></label>
                                <select type="text" name="plot_id" id="edit_checkin" class="form-control">
                                    <option value="">Select Plot</option>
                                    <?php $__currentLoopData = $plots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($plot->id); ?>"><?php echo e($plot->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label> Notes<span class="text-danger">*</span></label>
                                <textarea name="note" id="" cols="3" rows="2" style="width: 100%"></textarea>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/property/propertyType.blade.php ENDPATH**/ ?>