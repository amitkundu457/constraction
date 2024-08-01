

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Service Scheduling')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('equipments.index')); ?>"><?php echo e(__('Equipment')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Service')); ?></li>
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
                            <th>Equipment</th>
                            <th>Service Frequency</th>
                            <th>Service On</th>
                            <th>Assigned To</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $eqpms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqpm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>
                                <td><?php echo e($eqpm->type ? 'Maintainance' : 'Calibration'); ?>

                                <td><?php echo e($eqpm->equipment->name); ?></td>
                                 <td><?php echo e($eqpm->service_frequency_time); ?> <?php echo e(ucfirst($eqpm->service_frequency_type)); ?>

                                </td>
                                <td><?php echo e($eqpm->quality->verification_method); ?></td>
                                <td><?php echo e($eqpm->agent->name); ?></td>
                                


                                
                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Report"
                                            href="<?php echo e(route('equipment.maintainance.show', $eqpm->id)); ?>">
                                            <i class="ti ti-file-text"></i>
                                        </a>
                                        <a data-bs-target="#edit_modal-<?php echo e($eqpm->id); ?>" style="margin-left: 0.5rem" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary text-white"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal-<?php echo e($eqpm->id); ?>"
                                            data-id="<?php echo e($eqpm->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($eqpm->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">

                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="<?php echo e(route('equipment.maintainance.delete', $eqpm->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($eqpm->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Service Schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('equipment.maintainance.update', $eqpm->id)); ?>"
                                                        method="post" x-data="loadquality()">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class=" row" x-init="getQuality(<?php echo e($eqpm->equipment_id); ?>)">
                                                            <div class="form-group col-md-6">
                                                                <label>Equipment <span class="text-danger">*</span></label>
                                                                <select class="form-control"
                                                                    x-on:change="getQuality($event.target.value)"
                                                                    name="equipment_id" id="" required>
                                                                    <option value="">-- Select Equipment --</option>
                                                                    <?php $__currentLoopData = $eqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($eqp->id); ?>" <?php if($eqpm->equipment_id == $eqp->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($eqp->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="service_type"
                                                                    id="" required>
                                                                    <option value="">Select Service Type</option>
                                                                    <option value="0" <?php if(!$eqpm->service_type): echo 'selected'; endif; ?>>Calibration</option>
                                                                    <option value="1" <?php if($eqpm->service_type): echo 'selected'; endif; ?>>Maintainance</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label>Verification Method <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="quality_control_id"
                                                                    id="" required>
                                                                    <template x-if="!quals">
                                                                        <option value="">-- Select Verification Method
                                                                            --</option>
                                                                    </template>
                                                                    <template x-if="quals && quals.length > 0">
                                                                        <template x-for="qual in quals">
                                                                            <option :value="qual.id"
                                                                                x-text="qual.verification_method" :selected="qual.id === <?php echo e($eqpm->quality_control_id); ?>">4</option>
                                                                        </template>
                                                                    </template>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Assigned To <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="agent_id" id=""
                                                                    required>
                                                                    <option value="">-- Select Assigned --</option>
                                                                    <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($agent->id); ?>" <?php if($agent->id == $eqpm->agent_id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($agent->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label> Service Frequency Time <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="service_frequency_time"
                                                                    id="edit_checkin" class="form-control" required
                                                                    value="<?php echo e($eqpm->service_frequency_time); ?>" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Service Frequency Type <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="service_frequency_type"
                                                                    id="" required>
                                                                    <option value="">Select Service Frequency Type
                                                                    </option>
                                                                    <option value="days" <?php if($eqpm->service_frequency_type == 'days'): echo 'selected'; endif; ?>>Days</option>
                                                                    <option value="weeks" <?php if($eqpm->service_frequency_type == 'weeks'): echo 'selected'; endif; ?>>Weeks</option>
                                                                    <option value="months" <?php if($eqpm->service_frequency_type == 'months'): echo 'selected'; endif; ?>>Months</option>
                                                                    <option value="years" <?php if($eqpm->service_frequency_type == 'years'): echo 'selected'; endif; ?>>Years</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label> Description</label>
                                                            <textarea name="description" id="" class="form-control" cols="3" rows="2" style="width: 100%"><?php echo e($eqpm->description); ?></textarea>
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
                        <h5 class="modal-title">Add Service Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('equipment.maintainance.store')); ?>" method="post"
                            x-data="loadquality()">
                            <?php echo csrf_field(); ?>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Equipment <span class="text-danger">*</span></label>
                                    <select class="form-control" x-on:change="getQuality($event.target.value)"
                                        name="equipment_id" id="" required>
                                        <option value="">-- Select Equipment --</option>
                                        <?php $__currentLoopData = $eqps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eqp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($eqp->id); ?>"><?php echo e($eqp->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_type" id="" required>
                                        <option value="">Select Service Type</option>
                                        <option value="0">Calibration</option>
                                        <option value="1">Maintainance</option>
                                    </select>
                                </div>

                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label>Verification Method <span class="text-danger">*</span></label>
                                    <select class="form-control" @change="desc = $event.target.options[$event.target.selectedIndex].dataset.title" name="quality_control_id" id="" required>
                                        <template x-if="!quals">
                                            <option value="">-- Select Verification Method --</option>
                                        </template>
                                        <template x-if="quals && quals.length > 0">
                                            <template x-for="qual in quals">
                                                <option :value="qual.id" :data-title="qual.description" x-text="qual.verification_method"></option>
                                            </template>
                                        </template>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Assigned To <span class="text-danger">*</span></label>
                                    <select class="form-control" name="agent_id" id="" required>
                                        <option value="">-- Select Assigned --</option>
                                        <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($agent->id); ?>"><?php echo e($agent->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label> Service Frequency Time <span class="text-danger">*</span></label>
                                    <input type="number" name="service_frequency_time" id="edit_checkin"
                                        class="form-control" required value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Service Frequency Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="service_frequency_type" id="" required>
                                        <option value="">Select Service Frequency Type</option>
                                        <option value="days">Days</option>
                                        <option value="weeks">Weeks</option>
                                        <option value="months">Months</option>
                                        <option value="years">Years</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label> Description <span class="text-danger">*</span></label>
                                <p x-text="desc"></p>
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

        function loadquality() {
            return {
                quals: null,
                desc:null,
                getQuality(id) {
                    fetch(`/equipment/quality/${id}`).then((res) => res.json()).then((data) => this.quals = data.quality)
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/equipment/maintainance.blade.php ENDPATH**/ ?>