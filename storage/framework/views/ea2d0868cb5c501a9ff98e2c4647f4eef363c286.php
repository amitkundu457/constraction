<?php $__env->startPush('css-page'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/file-manager/css/file-manager.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('File Manager')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div id="fm" style="height: 600px;"></div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('vendor/file-manager/js/file-manager.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/filemanager/index.blade.php ENDPATH**/ ?>