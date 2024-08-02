<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payslip')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('payslip')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
                <?php echo e(Form::open(['route' => ['payslip.store'], 'method' => 'POST', 'id' => 'payslip_form'])); ?>

                <div class="d-flex align-items-center justify-content-end">
                    <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                        <div class="btn-box">
                            <?php echo e(Form::label('month', __('Select Month'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::select('month', $month, date('m'), ['class' => 'form-control select', 'id' => 'month'])); ?>

                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                        <div class="btn-box">
                            <?php echo e(Form::label('year', __('Select Year'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::select('year', $year, null, ['class' => 'form-control select'])); ?>

                        </div>
                    </div>
                    <div class="col-auto float-end ms-2 mt-4">
                        <a href="#" class="btn  btn-primary"
                            onclick="document.getElementById('payslip_form').submit(); return false;"
                            data-bs-toggle="tooltip" title="<?php echo e(__('payslip')); ?>"
                            data-original-title="<?php echo e(__('payslip')); ?>"><?php echo e(__('Generate Payslip')); ?>

                        </a>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center justify-content-start mt-2">
                            <h5><?php echo e(__('Find Employee Payslip')); ?></h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex align-items-center justify-content-end ">
                            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                                <div class="btn-box">
                                    <select class="form-control month_date " name="year" tabindex="-1"
                                        aria-hidden="true">
                                        <option value="--">--</option>
                                        <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $mon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $selected = date('m') == $k ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo e($k); ?>" <?php echo e($selected); ?>><?php echo e($mon); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12 me-2">
                                <div class="btn-box">
                                    <?php echo e(Form::select('year', $year, null, ['class' => 'form-control year_date '])); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end me-2">
                                <?php echo e(Form::open(['route' => ['payslip.export'], 'method' => 'POST', 'id' => 'payslip_form'])); ?>

                                <input type="hidden" name="filter_month" class="filter_month">
                                <input type="hidden" name="filter_year" class="filter_year">
                                <input type="submit" value="<?php echo e(__('Export')); ?>" class="btn btn-primary">
                                <?php echo e(Form::close()); ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-render-column-cells">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Employee Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Payroll Type')); ?></th>
                                <th><?php echo e(__('Salary')); ?></th>
                                <th><?php echo e(__('Net Salary')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <div class="d-flex gap-1">
                                            <h5 class="text-info">01 - 30 Jun, 24</h5>
                                            <p class="text-secondary" style="font-size: 13px; font-weight:600">includes 3 employees</p>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <p class="">Monthly - None Based |</p>
                                            <p class=""><span class="h5 text-info">Mannual</span> - followed by customized</p>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <h5 class="text-info">ID :</h5>
                                            <p class="text-secondary" style="font-size: 13px; font-weight:600">ADCXYZ</p>
                                        </div>
                                        <div class="d-flex gap-2">
                                           <button class="btn btn-sm border border-secondary text-secondary">View Payslip</button>
                                            <button class="btn btn-sm border border-danger text-danger"><i class="ti ti-download"></i> Export</button>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td colspan="3">
                                    <div>
                                        <div>
                                            <span class="bg-secondary px-2 rounded-pill text-white" style="font-weight: 600">Generated</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-1" style="font-size:13px;""> 
                                            <p class="text-secondary"><i class="ti ti-calendar"></i></p>
                                            <p class="text-secondary" style="font-size:13px;">Created At</p>
                                            <p style="font-size:13px;">Today</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-1" style="font-size:13px;""> 
                                            <p class="text-secondary"><i class="ti ti-user-check"></i></p>
                                            <p class="text-secondary" style="font-size:13px;">Not yet send</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-1" style="font-size:13px;""> 
                                            <p class="text-secondary"><i class="ti ti-flag"></i></p>
                                            <p style="font-size:13px; font-weight: 600; color:#ff7200;">Payslip of 2 employees are conflicted <a href="#" style="color:#075cdb">Manage</a></p>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/payslip/index.blade.php ENDPATH**/ ?>