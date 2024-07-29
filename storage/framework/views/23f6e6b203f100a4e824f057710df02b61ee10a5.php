
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Purchase')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Daily Purchase Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
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
    <script>
        (function() {
            var chartBarOptions = {
                series: [{
                    name: '<?php echo e(__('Purchase')); ?>',
                    data: <?php echo json_encode($data); ?>,
                    // data:   [300,80,400,200,100,300,100,290,156,250,350,200,80,230,120,300,180,300,400,280,100,150,280,100,160,100,300,150,100,90],
                }, ],

                chart: {
                    height: 300,
                    type: 'area',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($arrDuration); ?>,
                    title: {
                        text: '<?php echo e(__('Days')); ?>'
                    }
                },
                colors: ['#6fd944', '#6fd944'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__('Amount')); ?>'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#daily-purchase"), chartBarOptions);
            arChart.render();
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip"
            title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
        
        
    </ul>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 ">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['report.daily.purchase'], 'method' => 'GET', 'id' => 'daily_purchase_report_submit'])); ?>

                        <div class="row d-flex align-items-center justify-content-end">
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <input type="date" class="form-control" name="start_date"
                                        value="<?php echo e(request('start_date', \Carbon\Carbon::now()->format('Y-m-d'))); ?>">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <input type="date" name="end_date" class="form-control"
                                        value="<?php echo e(request('end_date', \Carbon\Carbon::now()->format('Y-m-d'))); ?>">

                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">

                                    <?php echo e(Form::select('vendor', $vendor, isset($_GET['vendor']) ? $_GET['vendor'] : '', ['class' => 'form-control select'])); ?>

                                </div>
                            </div>

                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                    onclick="document.getElementById('daily_purchase_report_submit').submit(); return false;"
                                    data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('report.daily.purchase')); ?>" class="btn btn-sm btn-danger"
                                    data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                                </a>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">

        <div class="row mt-0">
            <div class="col">
                <input type="hidden"
                    value="<?php echo e($filter['warehouse'] . ' ' . __('Daily Purchase') . ' ' . 'Report of' . ' ' . $filter['startDate'] . ' to ' . $filter['endDate']); ?>"
                    id="filename">
                <div class="card p-4 mb-4">
                    
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e(__('Daily Purchase Report')); ?>

                    </h6>
                </div>
            </div>
            <?php if(!empty($filter['warehouse'])): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Warehouse')); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($filter['warehouse']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($filter['vendor'])): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Vendor')); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($filter['vendor']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e($filter['startDate'] . ' to ' . $filter['endDate']); ?></h6>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="setting-tab">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="daily-chart" role="tabpanel">
                                <div class="col-lg-12">
                                    <div class="card-header">
                                        <div class="row ">
                                            <div class="col-6">
                                                <h6><?php echo e(__('Daily Report')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="daily-purchase"></div>
                                    </div>
                                    <table class="table datatable dataTable-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Supplier</th>
                                                <th>Site Name</th>

                                                <th>Date</th>
                                                <th>Quantity</th>
                                                <th>Tax(CGST)</th>
                                                <th>Total Price</th>

                                            </tr>
                                        </thead>
                                        <?php $__currentLoopData = $purdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchaseDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tbody>
                                                <tr>
                                                <tr>
                                                    <td><?php echo e($purchaseDetail->name); ?></td>
                                                    <td><?php echo e($purchaseDetail->cname); ?></td>
                                                    <td><?php echo e($purchaseDetail->vname); ?></td>

                                                    <td><?php echo e($purchaseDetail->purchase_date); ?></td>
                                                    <td><?php echo e($purchaseDetail->quantity); ?></td>
                                                    <td><?php echo e($purchaseDetail->getTotalTax()); ?></td>
                                                    
                                                    <td><?php echo e($purchaseDetail->getTotal()); ?></td>
                                                </tr>
                                            </tbody>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/report/daily_purchase.blade.php ENDPATH**/ ?>