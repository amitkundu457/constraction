
<?php
    $settings = Utility::settings();
    $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
?>
<html lang="en" dir="<?php echo e($settings == 'on'?'rtl':''); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">

    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" >

    <title><?php echo e(env('APP_NAME')); ?> - Balance Sheet</title>
    <?php if(isset($settings['SITE_RTL'] ) && $settings['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
    <?php endif; ?>
</head>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 4,
                    dpi: 72,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A2'
                }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#filter").click(function() {
                $("#show_filter").toggle();
            });
        });
    </script>

<script>
    window.print();
    window.onafterprint = back;

    function back() {
        window.close();
        window.history.back();
    }
</script>

<body class="<?php echo e($color); ?>">
    <div class="mt-4">
        <?php
            $authUser = \Auth::user()->creatorId();
            $user = App\Models\User::find($authUser);
        ?>
        <div class="row justify-content-center" id="printableArea">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="account-main-title mb-5">
                            <h5><?php echo e('Balance Sheet of ' . $user->name . ' as of ' . $filter['startDateRange'] . ' to ' . $filter['endDateRange']); ?>

                                </h4>
                        </div>
                        <div
                            class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2">
                            <h6 class="mb-0"><?php echo e(__('Account')); ?></h6>
                            <h6 class="mb-0 text-center"><?php echo e(__('Account Code')); ?></h6>
                            <h6 class="mb-0 text-end"><?php echo e(__('Total')); ?></h6>
                        </div>

                        <?php
                            $totalAmount = 0;
                        ?>
                        <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($accounts != []): ?>
                                <div class="account-main-inner py-2">
                                    <?php if($type == 'Liabilities'): ?>
                                        <p class="fw-bold mb-3"> <?php echo e(__('Liabilities & Equity')); ?></p>
                                    <?php endif; ?>
                                    <p class="fw-bold ps-2 mb-2"><?php echo e($type); ?></p>

                                    <?php
                                        $total = 0;
                                    ?>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="border-bottom py-2">
                                            <p class="fw-bold ps-4 mb-2">
                                                <?php echo e($account['subType'] == true ? $account['subType'] : ''); ?></p>
                                            <?php $__currentLoopData = $account['account']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($key < count($account['account']) - 1): ?>
                                                    <?php if(!preg_match('/\btotal\b/i', $record['account_name'])): ?>
                                                        <div
                                                            class="account-inner d-flex align-items-center justify-content-between ps-5">
                                                            <p class="mb-2"><a
                                                                    href="<?php echo e(route('report.ledger',  $record['account_id'])); ?>?account=<?php echo e($record['account_id']); ?>"
                                                                    class="text-primary"><?php echo e($record['account_name']); ?></a>
                                                            </p>
                                                            <p class="mb-2 text-center"><?php echo e($record['account_code']); ?></p>
                                                            <p class="text-primary mb-2 float-end text-end">
                                                                <?php echo e($record['netAmount']); ?></p>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="account-inner d-flex align-items-center justify-content-between ps-4">
                                                <p class="fw-bold mb-2">
                                                    <?php echo e(end($account['account']) == true ? end($account['account'])['account_name'] : 0); ?>

                                                </p>
                                                <p class="fw-bold mb-2 text-end">
                                                    <?php echo e(end($account['account']) == true ? end($account['account'])['netAmount'] : 0); ?>

                                                </p>
                                            </div>
                                        </div>

                                        <?php
                                            $total += end($account['account']) == true ? end($account['account'])['netAmount'] : 0;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="aacount-title d-flex align-items-center justify-content-between border-top border-bottom py-2 px-2 pe-0">
                                        <h6 class="fw-bold mb-0"><?php echo e('Total for ' . $type); ?></h6>
                                        <h6 class="fw-bold mb-0 text-end"><?php echo e($total); ?></h6>
                                    </div>
                                    <?php
                                        if ($type != 'Assets') {
                                            $totalAmount += $total;
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if ($type == 'Assets') {
                                    continue;
                                }
                            ?>

                            <?php if($accounts != []): ?>
                                <div
                                    class="aacount-title d-flex align-items-center justify-content-between border-bottom py-2 px-0">
                                    <h6 class="fw-bold mb-0"><?php echo e('Total for Liabilities & Equity'); ?></h6>
                                    <h6 class="fw-bold mb-0 text-end"><?php echo e($totalAmount); ?></h6>
                                </div>
                            <?php endif; ?>

                            <?php
                                if ($type == 'Liabilities' || $type == 'Equity') {
                                    break;
                                }
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php /**PATH E:\laragon\www\construction\resources\views/report/balance_sheet_receipt.blade.php ENDPATH**/ ?>