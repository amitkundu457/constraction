

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Service Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('equipments.index')); ?>"><?php echo e(__('Equipment')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('equipment.maintainance.index')); ?>"><?php echo e(__('Service')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="my-5">


        <div class="d-flex justify-content-center align-items-center w-full pb-5">
            <h1 class="text-primary">SERVICE SCHEDULING REPORT</h1>
        </div>
        <div class="row mx-2 my-4">
            <div class="col-md-3">
                <h4 class="text-dark">Equipment</h4>
                <div class="my-2">
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Name : ' . $eqpm->equipment->name); ?>

                    </p>
                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Model : ' . $eqpm->equipment->model_number); ?>

                    </p>
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Type : ' . $eqpm->equipment->equipmentType->name); ?>

                    </p>
                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Manufacturer : ' . $eqpm->equipment->equipmentManufacturer->name); ?>

                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Verification Method</h4>
                <div class="">

                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Type : ' . $eqpm->quality->verification_method); ?>

                    </p>
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Criteria : ' . $eqpm->quality->acceptance_criteria); ?>

                    </p>

                </div>
            </div>
            <div class="col-md-3">
                <h4>Service Details</h4>
                <div class="my-2">

                    <p class="text-secondary  mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Frequency : ' . $eqpm->service_frequency_time . ' ' . ucfirst($eqpm->service_frequency_type)); ?>

                    </p>
                    <p class="text-secondary mt-3" style="font-weight: 500; font-size:14px;">
                        <?php echo e('Criteria : ' . $eqpm->description); ?>

                    </p>

                </div>
            </div>
            <div class="col-md-3">
                <h4>Service Type</h4>
                <div>
                    <p class=" badge rounded-pill text-white px-2 <?php echo e($eqpm->service_type == 1 ? 'bg-danger ' : 'bg-warning'); ?> "
                        style="font-weight: 500; font-size:12px;">
                        <?php echo e($eqpm->service_type == 1 ? 'Maintainance' : 'Calibration'); ?>

                    </p>
                </div>
            </div>
        </div>
        <form action="<?php echo e(route('equipment.maintainance.review',$eqpm->id)); ?>" method="post" class="mx-2">
            <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="" class="form-label">Condition <span class="text-danger">*</span></label>
                    <select name="equipment_condition_id" id="" class="form-control" required>
                        <option value="">-- Select Condition --</option>
                        <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($condition->id); ?>" <?php if($eqpm && $eqpm->equipment_condition_id == $condition->id): echo 'selected'; endif; ?>><?php echo e($condition->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="" class="form-label">Review Date <span class="text-danger">*</span></label>
                    <input type="date" name="review_date" id="" value="<?php echo e($eqpm->review_date ?? ''); ?>" class="form-control" required>
                </div>
            </div>
            <div class="row ">
                <div class="form-group col-md-12">
                    <label for="" class="form-label">Review Report <span class="text-danger">*</span></label>
                    <textarea name="report" id="" cols="30" rows="5" class="form-control" required><?php echo e($eqpm->report ?? ''); ?></textarea>
                </div>
            </div>
            <div>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>

    </div>
    <script>
        // $(document).ready(function() {
        //     $('.deletebtn').on('click', function() {
        //         var id = $(this).data('id');
        //         $('#delete_id').val(id);
        //     });
        // });

        function loadquality() {
            return {
                quals: null,
                desc: null,
                getQuality(id) {
                    fetch(`/equipment/quality/${id}`).then((res) => res.json()).then((data) => this.quals = data.quality)
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/equipment/maintainanceShow.blade.php ENDPATH**/ ?>