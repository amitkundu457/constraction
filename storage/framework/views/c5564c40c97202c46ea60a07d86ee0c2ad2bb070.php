

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Payments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Payments')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <?php if($firstInstallment && $firstInstallment->status == 0): ?>
        <form action="<?php echo e(url('make-payment-store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="invoice_id" value="<?php echo e($deal->id); ?>">
            <input type="hidden" name="payment_plan_id" value="<?php echo e($firstInstallment->id); ?>">

            <div class="form-group">
                <label for="installment_name">Installment Name</label>
                <input type="text" class="form-control" name="installment_name"
                    value="<?php echo e($firstInstallment->installment_name); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" class="form-control" name="payment_date">
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" name="due_date" value="<?php echo e($firstInstallment->due_date); ?>">
            </div>
            <div class="form-group">
                <label for="paid_amount">Amount</label>
                <input type="text" class="form-control" name="paid_amount"
                    value="<?php echo e($firstInstallment->installment_price); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Save Payment</button>
        </form>
    <?php else: ?>
        
        <?php
            $nextInstallment = $installments->first(function ($installment) {
                return $installment->status == 0; // Assuming '0' indicates unpaid status
            });

        ?>

        <?php if($nextInstallment): ?>
            
            <form action="<?php echo e(url('make-payment-store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="text" name="invoice_id" value="<?php echo e($deal->id); ?>">
                <input type="text" name="payment_plan_id" value="<?php echo e($nextInstallment->id); ?>">

                <div class="form-group">
                    <label for="installment_name">Installment Name</label>
                    <input type="text" class="form-control" name="installment_name"
                        value="<?php echo e($nextInstallment->installment_name); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <input type="date" class="form-control" name="payment_date">
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" name="due_date" value="<?php echo e($nextInstallment->due_date); ?>">
                </div>
                <div class="form-group">
                    <label for="paid_amount">Amount</label>
                    <input type="text" class="form-control" name="paid_amount"
                        value="<?php echo e($nextInstallment->installment_price); ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save Payment</button>
            </form>
        <?php else: ?>
            
            <p>All installments have been paid.</p>
        <?php endif; ?>
    <?php endif; ?>

    






    <script>
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/property/make_payment.blade.php ENDPATH**/ ?>