
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Spredsheet Online')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('sheet.create')); ?>" class="btn btn-sm btn-primary">
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
                            <th> TimeStamp</th>
                            <th class="text-end" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($sheet->title); ?> </td>
                                <td><?php echo e(Carbon\Carbon::parse($sheet->created_at)->format('d M, y h:i A')); ?></td>
                                <td class="text-end">
                                    <div class="" style="display: flex; justify-content: end">
                                        <a href="<?php echo e(route('sheet.edit', $sheet->id)); ?>" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil"></i> </a>

                                        <?php if($sheet->share()->where('sheet_id', $sheet->id)->exists()): ?>
                                            <?php echo Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['sheet.share.destroy', $sheet->id],
                                                'id' => 'delete-form-' . $sheet->id,
                                            ]); ?>

                                            <button type="button" class="btn btn-sm btn-warning bs-pass-para"
                                                style="margin-left: 0.5rem" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>"
                                                data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                data-confirm-yes="document.getElementById('delete-form-<?php echo e($sheet->id); ?>').submit();">
                                                <i class="ti ti-x"></i>
                                            </button>
                                            <?php echo Form::close(); ?>

                                            <a href="<?php echo e(route('sheet.share.show',$sheet->id)); ?>" class="btn btn-sm btn-info" style="margin-left: 0.5rem"><i
                                                class="fa fa-eye "></i> </a>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-secondary"
                                                data-bs-target="#share_<?php echo e($sheet->id); ?>" data-bs-toggle="modal"
                                                style="margin-left: 0.5rem">
                                                <i class="ti ti-share"></i>
                                            </button>
                                        <?php endif; ?>
                                        
                                        <a class="btn btn-sm btn-danger " style="margin-left: 0.5rem"
                                            href="javascript:void(0)">
                                            <i class="ti ti-trash"></i>
                                        </a>

                                    </div>
                                    
                                    <div class="modal custom-modal fade" id="share_<?php echo e($sheet->id); ?>" role="dialog">
                                        <div class="modal-dialog modal-lg " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Share Sheet</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <form action="<?php echo e(route('sheet.share', $sheet->id)); ?>" method="post" x-data="{type:1}">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row my-2">
                                                            <p>Whom do you want to share</p>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="type" x-on:click="type = $event.target.value" value="1" checked />
                                                                    <label class="form-check-label" for="">Employee
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="type" x-on:click="type = $event.target.value" value="2" />
                                                                    <label class="form-check-label" for="">Customer
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div id="emp" class="form-group" x-bind:class="type == 2 ? 'd-none' : ''">
                                                                <label for="" class="form-label">Employee</label>
                                                                <select name="employee_id" class="form-control">
                                                                    <option value="">--Select Employee --</option>
                                                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($emp->id); ?>">
                                                                            <?php echo e($emp->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div id="cust" class="form-group" x-bind:class="type == 1 ? 'd-none' : ''">
                                                                <label for="" class="form-label">Customer</label>
                                                                <select name="user_id" class="form-control">
                                                                    <option value="">--Select Customer --</option>
                                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($emp->id); ?>">
                                                                            <?php echo e($emp->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row my-2">
                                                            <p>Permissions</p>
                                                            <div class="">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" name="is_editable"
                                                                        type="checkbox" role="switch"
                                                                        id="flexSwitchCheckDefault" checked>
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchCheckDefault">Edit</label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" name="is_viewable"
                                                                        type="checkbox" role="switch"
                                                                        id="flexSwitchCheckDefault" checked>
                                                                    <label class="form-check-label"
                                                                        for="flexSwitchCheckDefault">View</label>
                                                                </div>
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
                            <?php
                                $count++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/spreadsheet/index.blade.php ENDPATH**/ ?>