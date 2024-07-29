

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Promotion')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Promotion')); ?></li>
<?php $__env->stopSection(); ?>






<?php $__env->startSection('content'); ?>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <div class="row">
        <div class="col-md-6">
            <form action="<?php echo e(url('property-amenity-store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Amenity Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_checkin" class="form-control mt-2">
                </div>

                
                <div class="submit-section">
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Name</th>
                            <th>Timestamp</th>



                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr x-data="{aname:'<?php echo e($amenity->name); ?>'}">
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($amenity->name); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($amenity->created_at)->format('d M,Y h:i A')); ?></td>

                                <td class="text-end">
                                    <div class="gap-1" style="display: flex">
                                        <a data-bs-toggle="modal" data-bs-target="#edit_modal-<?php echo e($amenity->id); ?>"
                                            data-id="<?php echo e($amenity->id); ?>" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil text-white"></i> </a>
                                        
                                        <a class="btn btn-sm btn-danger" x-on:click="fetchAmenity(<?php echo e($amenity->id); ?>)" href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal" data-id="<?php echo e($amenity->id); ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <div class="modal custom-modal fade" id="edit_modal-<?php echo e($amenity->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Amenity <?php echo e($amenity->id); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <form action="<?php echo e(url('property-amenity-update', $amenity->id)); ?>"
                                                        method="post" >
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label>Amenity Name <span class="text-danger">*</span></label>
                                                            <input type="text" x-bind:value="aname" name="name" id="edit_checkin"
                                                                class="form-control mt-2">
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
                                                    <div class="form-header text-start">
                                                        
                                                        <p class="my-3">Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="<?php echo e(url('property-amenity-delete', $amenity->id)); ?>"
                                                        method="post">
                                                        <?php echo method_field('delete'); ?>
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Yes</button>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/property/propertyAmenity.blade.php ENDPATH**/ ?>