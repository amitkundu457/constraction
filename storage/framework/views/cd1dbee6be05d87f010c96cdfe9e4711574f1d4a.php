

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Deal')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Deal')); ?></li>
<?php $__env->stopSection(); ?>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
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
                            <th>Client Name</th>
                            <th>Property Name</th>
                            <th>invoice No</th>
                            <th>invoice date</th>
                            <th>area</th>
                            <th>total amount</th>
                            <th>Due blance</th>
                            <th>Status</th>



                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $deal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($propertie->firstname . '  ' . $propertie->lastname); ?></td>
                                <td><?php echo e($propertie->title); ?></td>
                                <td><?php echo e($propertie->invoice_id); ?></td>
                                <td><?php echo e($propertie->invoice_date); ?></td>
                                <td><?php echo e($propertie->area); ?></td>
                                <td><?php echo e($propertie->price); ?></td>
                                <?php
                                    $due = $propertie->price - $propertie->booking_amount;
                                    $installments = App\Models\Installment::where('deal_id', $propertie->id)
                                        ->orderBy('due_date')
                                        ->get();
                                    $firstInstallment = $installments->first();
                                    $nextInstallment = $installments->first(function ($installment) {
                                        return $installment->status == 0; // Assuming '0' indicates unpaid status
                                    });
                                ?>

                                <td><?php echo e($due); ?></td>
                                <td>
                                    <?php if($firstInstallment && $firstInstallment->status == 0): ?>
                                        <span class="text-danger">Unpaid</span>
                                    <?php else: ?>
                                        <?php if($nextInstallment): ?>
                                            <div class="bg-danger text-center">Unpaid</div>
                                        <?php else: ?>
                                            
                                            <div class="bg-success text-center">paid</div>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                </td>



                                <td class="text-end">

                                    <div class="dropdown">
                                        <a class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li style="font-size: 14px"><a data-toggle="modal"
                                                    data-target="#edit_modal-<?php echo e($propertie->id); ?>"
                                                    data-id="<?php echo e($propertie->id); ?>" class="dropdown-item"> Edit</a></li>
                                            <li style="font-size: 14px"> <a class="dropdown-item"
                                                    href="<?php echo e(url('make-payment', $propertie->id)); ?>">Make Payment</a></li>
                                            <li style="font-size: 14px"><a class="dropdown-item"
                                                    href="<?php echo e(url('make-payment-history', $propertie->id)); ?>">Payment
                                                    History</a></li>
                                            <li style="font-size: 14px"> <a class="dropdown-item"
                                                    href="<?php echo e(url('show-payment', $propertie->id)); ?>">Payment Plan</a></li>
                                            <li style="font-size: 14px"> <a class="dropdown-item deletebtn"
                                                    href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#delete_modal" data-id="<?php echo e($propertie->id); ?>">
                                                    Delete
                                                </a></li>
                                        </ul>
                                    </div>

                                    <div class="modal custom-modal fade" id="edit_modal-<?php echo e($propertie->id); ?>"
                                        role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property Type <?php echo e($propertie->id); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(url('payment-plan-update', $propertie->id)); ?>"
                                                        method="post" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label> Title <span class="text-danger">*</span></label>
                                                            <input value="<?php echo e($propertie->name); ?>" type="text"
                                                                name="name" id="edit_checkin" class="form-control">
                                                        </div>



                                                        
                                                        <div class="submit-section">
                                                            <button type="submit"
                                                                class="btn btn-primary submit-btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        
                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="<?php echo e(url('payment-plan-delete', $propertie->id)); ?>"
                                                        method="get">
                                                        
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" id="delete_id" name="id">
                                                        <div class="modal-btn delete-action">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <button class="btn btn-primary continue-btn btn-block"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="col-6">
                                                                    <button data-dismiss="modal"
                                                                        class="btn btn-primary cancel-btn btn-block">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $count++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex justify-content-center">
                            
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Plans</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" x-data="propertyPrices()">
                        <form action="<?php echo e(url('deal-store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Client Name <span class="text-danger">*</span></label>
                                    <select name="client_id" class="form-control" id="">
                                        <option value="">Client Name</option>
                                        <?php $__currentLoopData = $client; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($clients->id); ?>"><?php echo e($clients->firstname); ?>

                                                <?php echo e($clients->lastname); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                </div>
                                <div class="form-group col-4">
                                    <label>Property Type <span class="text-danger">*</span></label>
                                    <select name="type_id" class="form-control" id="">
                                        <option value="">property Type</option>
                                        <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($clients->id); ?>"><?php echo e($clients->type_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                </div>
                                <div class="form-group col-4">
                                    <label>Available For <span class="text-danger">*</span></label>
                                    <select name="contract_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php $__currentLoopData = $contrct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($clients->id); ?>"><?php echo e($clients->contruct_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-4" x-model="selectedPropertyId" @change="fetchPrices">
                                    <label>Property name <span class="text-danger">*</span></label>
                                    <select name="property_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($clients->id); ?>"><?php echo e($clients->title); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>


                                </div>
                                <div class="form-group col-4">
                                    <label>Invoice Date <span class="text-danger">*</span></label>
                                    <input type="date" name="invoice_date" id="" class="form-control">


                                </div>
                                <div class="form-group col-4">
                                    <label>Booking Amount<span class="text-danger">*</span></label>
                                    <input type="number" name="booking_amount" id="" class="form-control">

                                </div>


                                <template x-if="prices.price">
                                    <div class="row">
                                        

                                        
                                        <div class="form-group col-6">
                                            <label>Amount<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="price"
                                                :value="prices.price">


                                        </div>
                                        <div class="form-group col-6">
                                            <label>Area <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" :value="prices.area"
                                                name="area">


                                        </div>

                                    </div>
                                </template>



                                <div class="form-group col-6">
                                    <label>Payment Plan<span class="text-danger">*</span></label>
                                    <select name="installment_id" class="form-control" id="">
                                        <option value="">Please Select</option>
                                        <?php $__currentLoopData = $planp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clients): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($clients->id); ?>"><?php echo e($clients->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                
                            </div>



                            
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function propertyPrices() {
            return {
                selectedPropertyId: '',
                prices: [],
                async fetchPrices() {
                    if (!this.selectedPropertyId) {
                        this.prices = [];
                        return;
                    }

                    try {
                        const response = await fetch(`/price/${this.selectedPropertyId}`);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const data = await response.json();

                        this.prices = data;
                        console.log(this.prices.price, this.prices.area);
                    } catch (error) {
                        console.error('Error fetching prices:', error);
                        this.prices = [];
                    }
                }
            };
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/property/deal.blade.php ENDPATH**/ ?>