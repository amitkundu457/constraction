
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Word Online')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('word.create')); ?>" class="btn btn-sm btn-primary">
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
                        <?php $__currentLoopData = $words; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $word): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($word->name); ?> </td>
                                <td><?php echo e(Carbon\Carbon::parse($word->created_at)->format('d M, y h:i A')); ?></td>
                                <td class="text-end">
                                    <div class="" style="display: flex; justify-content: end">
                                        <a href="<?php echo e(route('word.edit', $word->id)); ?>" class="btn btn-sm btn-primary"><i
                                                class="ti ti-pencil"></i> </a>

                                        
                                        
                                        
                                        <a class="btn btn-sm btn-secondary" style="margin-left: 0.5rem"
                                            href="<?php echo e(route('word.show', $word->id)); ?>">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger " style="margin-left: 0.5rem"
                                            href="javascript:void(0)">
                                            <i class="ti ti-trash"></i>
                                        </a>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/word/index.blade.php ENDPATH**/ ?>