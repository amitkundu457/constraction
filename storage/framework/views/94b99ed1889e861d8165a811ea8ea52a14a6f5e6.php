
<?php
    // $profile=asset(Storage::url('uploads/avatar/'));
    $profile = \App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Agents')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Agent')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('agents.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip"
                title="<?php echo e(__('Create Agent')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Deals</th>
                        <th>TimeStamp</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                    ?>
                    <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$i); ?></td>
                            <td><?php echo e($agent->name); ?></td>
                            <td><?php echo e($agent->email); ?></td>
                            <td><?php echo e($agent->contact); ?></td>
                            <td><?php echo e($agent->property->count() . ' Properties'); ?></td>
                            <td><?php echo e(Carbon\Carbon::parse($agent->created_at)->format('d M, Y h:i A')); ?></td>
                            <td>
                                <div class="" style="display: flex">
                                    <a href="#" data-size="lg" data-url="<?php echo e(route('agents.edit', $agent->id)); ?>"
                                        data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Update')); ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <?php echo Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['agents.destroy', $agent->id],
                                        'id' => 'delete-form-' . $agent->id,
                                    ]); ?>

                                    <a href="#" class="mx-1 btn btn-sm bg-danger align-items-center bs-pass-para"
                                        data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($agent->id); ?>').submit();">
                                        <i class="ti ti-trash text-white"></i>
                                    </a>
                                    <?php echo Form::close(); ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/agents/index.blade.php ENDPATH**/ ?>