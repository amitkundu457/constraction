

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bookings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Booking')); ?></li>
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
                            <th>Vehicle Type</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count++); ?></td>

                                <td><?php echo e($booking->vehicle->number.' - '.$booking->vehicle->code); ?></td>
                                <td><?php echo e($booking->vehicleType->name); ?></td>
                                <td><?php echo e($booking->user->name); ?></td>
                                <td>&#8377; <?php echo e($booking->amount); ?></td>
                                <td>
                                    <?php echo e(ucfirst(str_replace('_', ' ', $booking->type))); ?><i style="margin-left: 5px" class="<?php echo e($booking->type == 'single_trip' ? __('ti ti-arrow-up text-danger') : __('ti ti-arrows-sort text-info')); ?>"></i>
                                </td>
                                <td>
                                    <?php if($booking->status == 'yet_to_start'): ?>
                                        <span
                                            class="badge badge-info bg-info text-light"><?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?></span>
                                    <?php elseif($booking->status == 'complete'): ?>
                                        <span
                                            class="badge badge-success bg-success text-light"><?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?></span>
                                    <?php elseif($booking->status == 'ongoing'): ?>
                                        <span
                                            class="badge badge-warning bg-warning text-dark"><?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?></span>
                                    <?php elseif($booking->status == 'cancelled'): ?>
                                        <span
                                            class="badge badge-danger bg-danger text-light"><?php echo e(ucfirst(str_replace('_', ' ', $booking->status))); ?></span>
                                    <?php endif; ?>
                                </td>

                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($booking->id); ?>" data-bs-toggle="modal"
                                            class="btn btn-sm btn-primary text-light"><i class="ti ti-pencil"></i> </a>
                                        
                                        
                                        
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete_modal-<?php echo e($booking->id); ?>"
                                            data-id="<?php echo e($booking->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal-<?php echo e($booking->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h5 class="text-start mb-5 mt-2">Are you sure you want to delete
                                                            this record?</h5>

                                                    </div>
                                                    <form action="<?php echo e(route('vehicle.booking.delete', $booking->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($booking->id); ?>"
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
                                                    <form action="<?php echo e(route('vehicle.booking.update', $booking->id)); ?>"
                                                        method="post" x-data="loadvehicle()">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Customer <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="user_id" id=""
                                                                    required>
                                                                    <option value="">-- Select Customer --</option>
                                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($user->id); ?>"
                                                                            <?php if($booking->user_id == $user->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($user->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4" x-init="getVehicle(<?php echo e($booking->vehicle_type_id); ?>)">
                                                                <label>Vehicle Type <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control"
                                                                    @change="getVehicle($event.target.value)"
                                                                    name="vehicle_type_id" id="" required>
                                                                    <option value="">-- Select Vehicle Type --
                                                                    </option>
                                                                    <?php $__currentLoopData = $vtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($vtype->id); ?>"
                                                                            <?php if($booking->vehicle_type_id == $vtype->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($vtype->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Vehicle <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vehicle_id"
                                                                    id="" required>
                                                                    <template x-if="vehicles">
                                                                        <template x-for="vehicle in vehicles">
                                                                            <option :value="vehicle.id"
                                                                                x-text="vehicle.number+' - '+vehicle.code"
                                                                                :selected="<?php echo e($booking->vehicle_id); ?> == vehicle
                                                                                    .id">
                                                                            </option>
                                                                        </template>
                                                                    </template>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Driver <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="driver_id" id=""
                                                                    required>
                                                                    <option value="">-- Select Driver --</option>
                                                                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($driver->id); ?>" <?php if($booking->driver_id == $driver->id): echo 'selected'; endif; ?>>
                                                                            <?php echo e($driver->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="type" id=""
                                                                    required>
                                                                    <option value="">-- Select Trip Type --</option>
                                                                    <option value="single_trip" <?php if($booking->type == 'single_trip'): echo 'selected'; endif; ?>><?php echo e(__('Single Trip')); ?>

                                                                    </option>
                                                                    <option value="round_trip" <?php if($booking->type == 'round_trip'): echo 'selected'; endif; ?>><?php echo e(__('Round Trip')); ?>

                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Status <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="status" id=""
                                                                    required>
                                                                    <option value="">-- Select Status --</option>
                                                                    <option value="yet_to_start" <?php if($booking->status == 'yet_to_start'): echo 'selected'; endif; ?>>Yet To Start</option>
                                                                    <option value="completed" <?php if($booking->status == 'complete'): echo 'selected'; endif; ?>>Completed</option>
                                                                    <option value="ongoing" <?php if($booking->status == 'ongoing'): echo 'selected'; endif; ?>>On Going</option>
                                                                    <option value="cancelled" <?php if($booking->status == 'cancelled'): echo 'selected'; endif; ?>>Cancelled</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Start Location<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="text"
                                                                    name="start_location" id="" required value="<?php echo e($booking->start_location); ?>" >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip End Location<span
                                                                        class="text-danger">*</span></label>
                                                                <input class="form-control" type="text"
                                                                    name="end_location" id="" required value="<?php echo e($booking->end_location); ?>">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Amount <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="amount" id="edit_checkin"
                                                                    class="form-control" required value="<?php echo e($booking->amount); ?>">
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Trip Start Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="start_date" id="edit_checkin"
                                                                    class="form-control" required value="<?php echo e($booking->start_date); ?>">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Trip End Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" name="end_date" id="edit_checkin"
                                                                    class="form-control" required value="<?php echo e($booking->end_date); ?>">
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
                        <h5 class="modal-title">Create New Booking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('vehicle.booking.store')); ?>" method="post" x-data="loadvehicle()">
                            <?php echo csrf_field(); ?>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Customer <span class="text-danger">*</span></label>
                                    <select class="form-control" name="user_id" id="" required>
                                        <option value="">-- Select Customer --</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" @change="getVehicle($event.target.value)"
                                        name="vehicle_type_id" id="" required>
                                        <option value="">-- Select Vehicle Type --</option>
                                        <?php $__currentLoopData = $vtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($vtype->id); ?>"><?php echo e($vtype->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Vehicle <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vehicle_id" id="" required>
                                        <template x-if="vehicles">
                                            <template x-for="vehicle in vehicles">
                                                <option :value="vehicle.id" x-text="vehicle.number+' - '+vehicle.code">
                                                </option>
                                            </template>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Driver <span class="text-danger">*</span></label>
                                    <select class="form-control" name="driver_id" id="" required>
                                        <option value="">-- Select Driver --</option>
                                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($driver->id); ?>"><?php echo e($driver->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="type" id="" required>
                                        <option value="">-- Select Trip Type --</option>
                                        <option value="single_trip"><?php echo e(__('Single Trip')); ?></option>
                                        <option value="round_trip"><?php echo e(__('Round Trip')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="yet_to_start">Yet To Start</option>
                                        <option value="completed">Completed</option>
                                        <option value="ongoing">On Going</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Trip Start Location<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="start_location" id=""
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip End Location<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="end_location" id=""
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Trip Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date" id="edit_checkin" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trip End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="end_date" id="edit_checkin" class="form-control"
                                        required>
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

        function loadvehicle() {
            return {
                vehicles: null,
                getVehicle(id) {
                    fetch(`/vehicle/vehicle-type/${id}`).then((res) => res.json()).then((data) => this.vehicles = data
                        .vehicles)
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/fleet/booking.blade.php ENDPATH**/ ?>