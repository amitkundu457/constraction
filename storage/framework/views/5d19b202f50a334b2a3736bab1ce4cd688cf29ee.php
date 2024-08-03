<?php
    $logo=\App\Models\Utility::get_file('uploads/logo');
     $company_logo=Utility::getValByName('company_logo');
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payslip')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="text-md-right mb-2">
            <button type="button" class="btn btn-warning" onclick="saveAsPDF()"><span class="fa fa-download"></span></button>
        </div>
        <div class="col-8">
            <div class="invoice" id="printableArea">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h4><?php echo e(__('Payslip')); ?></h4>
                                <div class="invoice-number">
                                    <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo-dark.png')); ?>" width="170px;" alt="">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong><?php echo e(__('Name')); ?> :</strong> <?php echo e($employee->name); ?><br>
                                        <strong><?php echo e(__('Position')); ?> :</strong> <?php echo e(__('Employee')); ?><br>
                                        <strong><?php echo e(__('Salary Date')); ?> :</strong> <?php echo e(\Auth::user()->dateFormat( $employee->created_at)); ?><br>

                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong><?php echo e(\Utility::getValByName('company_name')); ?> </strong><br>
                                        <?php echo e(\Utility::getValByName('company_address')); ?> , <?php echo e(\Utility::getValByName('company_city')); ?>,<br>
                                        <?php echo e(\Utility::getValByName('company_state')); ?>-<?php echo e(\Utility::getValByName('company_zipcode')); ?><br>
                                        <strong><?php echo e(__('Salary Slip')); ?> :</strong> <?php echo e(\Auth::user()->dateFormat( $payslip->salary_month)); ?><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                    <tr>
                                        <th><?php echo e(__('Earning')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th class="text-end"><?php echo e(__('Amount')); ?></th>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('Basic Salary')); ?></td>
                                        <td>-</td>
                                        <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $payslip->basic_salary)); ?></td>
                                    </tr>
                                    <?php $__currentLoopData = $payslipDetail['earning']['allowance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(__('Allowance')); ?></td>
                                            <td><?php echo e($allowance->title); ?></td>
                                            <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $allowance->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $payslipDetail['earning']['commission']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(__('Commission')); ?></td>
                                            <td><?php echo e($commission->title); ?></td>
                                            <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $commission->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $payslipDetail['earning']['otherPayment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherPayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(__('Other Payment')); ?></td>
                                            <td><?php echo e($otherPayment->title); ?></td>
                                            <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $otherPayment->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $payslipDetail['earning']['overTime']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overTime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(__('OverTime')); ?></td>
                                            <td><?php echo e($overTime->title); ?></td>
                                            <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $overTime->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                    <tr>
                                        <th><?php echo e(__('Deduction')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th class="text-end"><?php echo e(__('Amount')); ?></th>
                                    </tr>

                                    <?php $__currentLoopData = $payslipDetail['deduction']['loan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(__('Loan')); ?></td>
                                            <td><?php echo e($loan->title); ?></td>
                                            <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $loan->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $payslipDetail['deduction']['deduction']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(__('Saturation Deduction')); ?></td>
                                            <td><?php echo e($deduction->title); ?></td>
                                            <td class="text-end"><?php echo e(\Auth::user()->priceFormat( $deduction->amount)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">

                                </div>
                                <div class="col-lg-4 text-end">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name"><?php echo e(__('Total Earning')); ?></div>
                                        <div class="invoice-detail-value"><?php echo e(\Auth::user()->priceFormat($payslipDetail['totalEarning'])); ?></div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name"><?php echo e(__('Total Deduction')); ?></div>
                                        <div class="invoice-detail-value"><?php echo e(\Auth::user()->priceFormat($payslipDetail['totalDeduction'])); ?></div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name"><?php echo e(__('Net Salary')); ?></div>
                                        <div class="invoice-detail-value invoice-detail-value-lg"><?php echo e(\Auth::user()->priceFormat($payslip->net_payble)); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3 ">
                        <p class="mt-2"><?php echo e(__('Employee Signature')); ?></p>
                    </div>
                    <p class="mt-2 "> <?php echo e(__('Paid By')); ?></p>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>

<script>

    function saveAsPDF() {
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 0.3,
            filename: '<?php echo e($employee->name); ?>',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save();
    }

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/payslip/payslipPdf.blade.php ENDPATH**/ ?>