<?php $__env->startPush('css-page'); ?>
    
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/css/pluginsCss.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/plugins/plugins.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/css/luckysheet.css' />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/luckysheet@latest/dist/assets/iconfont/iconfont.css' />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create Spreadsheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Spreadsheet')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        <button id="save-sheet" class="btn btn-sm btn-primary">
            <i class="ti ti-device-floppy"></i>
            <span>Save</span>
        </button>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12" style="position: relative;height:100%; ">
            <form action="<?php echo e(route('sheet.create')); ?>" method="post" id="sheetForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="title" name="title">
                <input type="hidden" id="data" name="data">
            </form>
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
                title: 'CRM & Real Estate',

            }
            luckysheet.create(options)

            $('#save-sheet').click(function() {
                $("#title").val($('#luckysheet_info_detail_input').val())
                $('#data').val(JSON.stringify(luckysheet.getAllSheets()))
                $("#sheetForm").submit();
            });

            // $('#share-sheet').click(function() {
            //     var sheetData = luckysheet.getAllSheets();

            //     $.ajax({
            //         url: '/spreadsheet/share', // Your route to handle sharing
            //         type: 'POST',
            //         data: {
            //             _token: '<?php echo e(csrf_token()); ?>',
            //             data: JSON.stringify(sheetData)
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 alert('Sheet shared successfully. Share this link: ' + response
            //                     .link);
            //                 // Optionally, display the link to the user
            //             } else {
            //                 alert('Error sharing sheet');
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             console.error('Error sharing sheet:', status, error);
            //             alert('Error sharing sheet');
            //         }
            //     });
            // });


        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/spreadsheet/create.blade.php ENDPATH**/ ?>