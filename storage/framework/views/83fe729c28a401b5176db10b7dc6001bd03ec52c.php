

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plot')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plot')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('plot.create')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
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
                            <th>Project name</th>
                            <th>Block Name</th>
                            <th>Phone No.</th>
                            <th>Total Plots</th>
                            <th> TimeStamp</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $plots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($plot->name); ?></td>
                                <td><?php echo e($plot->project_name); ?></td>
                                <td><?php echo e($plot->block_name); ?></td>
                                <td>
                                    <?php echo e($plot->phone_no); ?>

                                </td>


                                <td>
                                    <?php echo e($plot->total_plots); ?>

                                </td>
                                <td>
                                    <?php echo e(\Carbon\Carbon::parse($plot->created_at)->format('d M,Y h:i A')); ?>

                                </td>


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a href="<?php echo e(route('plot.edit', $plot->id)); ?>" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil"></i> </a>
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete_modal-<?php echo e($plot->id); ?>"
                                            data-id="<?php echo e($plot->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($plot->id); ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete this record?</h5>
                                                        
                                                    </div>
                                                    <form action="<?php echo e(route('plot.delete', $plot->id)); ?>" method="post">
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
                                </td>
                            </tr>
                            <?php
                                $count++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/plot/index.blade.php ENDPATH**/ ?>