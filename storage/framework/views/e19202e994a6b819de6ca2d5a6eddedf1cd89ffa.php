<?php $__env->startPush('css-page'); ?>
    
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/css/pluginsCss.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/plugins.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/css/luckysheet.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/assets/iconfont/iconfont.css' />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('View Spreadsheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Spreadsheet')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12" style="position: relative;height:100%; ">
            <div id="luckysheet" style="margin:0px;padding:0px;position:absolute;width:100%;height:600px;left:0px;top:0px;">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/js/plugin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/luckysheet.umd.js"></script>
    <script>
        $(document).ready(function() {
            var options = {
                container: 'luckysheet',
                title: <?php echo json_encode($share->sheet->title, 15, 512) ?>,
                data: <?php echo json_encode(json_decode($share->sheet->data), 15, 512) ?>,
                showtoolbar: true,
                functionButton:false,
                showsheetbarConfig:{
                    add:false,
                    sheet:false,
                },
                showtoolbarConfig:{
                    protection:false,
                },
                allowCopy:false,
                myFolderUrl:"<?php echo e(route('sheet.index')); ?>"
            };

            luckysheet.create(options);
            
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/spreadsheet/share.blade.php ENDPATH**/ ?>