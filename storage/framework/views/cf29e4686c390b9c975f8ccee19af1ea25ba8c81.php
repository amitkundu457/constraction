

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Promotion')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Promotion')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-bs-toggle="modal" data-bs-target="#callstore" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>



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

                            <th>Name</th>
                            <th>Type</th>
                            <th>Contract</th>
                            <th>Status</th>


                            <th> TimeStamp</th>

                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                        ?>
                        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($count); ?></td>

                                <td><?php echo e($propertie->title); ?></td>
                                <td><?php echo e($propertie->property_type); ?></td>
                                <td><?php echo e($propertie->contract_type); ?></td>
                                <td>
                                    <?php if($propertie->status == 0): ?>
                                        <span class="badge badge-danger text-danger">Sold</span>
                                    <?php elseif($propertie->status == 1): ?>
                                        <span class="badge text-primary">Available</span>
                                    <?php elseif($propertie->status == 2): ?>
                                        <span class="badge text-warning">Pending</span>
                                    <?php endif; ?>
                                </td>


                                <td><?php echo e(date_format(date_create($propertie->date), 'd M, Y')); ?>

                                    <?php echo e(date('g:i A', strtotime($propertie->time))); ?></td>
                                


                                <td class="text-end">
                                    <div class="" style="display: flex">
                                        <a data-bs-target="#edit_modal-<?php echo e($propertie->id); ?>" data-bs-toggle="modal"  class="btn btn-sm btn-primary"><i class="ti ti-pencil"></i> </a>
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="<?php echo e(url('property-document', $propertie->id)); ?>">
                                            <i class="ti ti-file"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"
                                            href="<?php echo e(url('property-photo', $propertie->id)); ?>">
                                            <i class="ti ti-file"></i>
                                        </a>
                                        <a class="btn btn-sm btn-primary" style="margin-left: 0.5rem"><i
                                                class="fa fa-eye m-r-5"></i> </a>
                                        <a class="btn btn-sm btn-danger" style="margin-left: 0.5rem"
                                            href="javascript:void(0)" data-toggle="modal" data-target="#delete_modal"
                                            data-id="<?php echo e($propertie->id); ?>">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                        
                                    </div>
                                    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        
                                                        <p>Are you sure you want to delete?</p>
                                                    </div>
                                                    <form action="<?php echo e(url('property-delete', $propertie->id)); ?>"
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
                                    <div class="modal custom-modal fade text-start" id="edit_modal-<?php echo e($propertie->id); ?>" role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Property</h5>
                                                    
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(url('property-update',$propertie->id)); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label>Property Title <span class="text-danger">*</span></label>
                                                            <input type="text" value="<?php echo e($propertie->title); ?>"  name="title" id="edit_checkin" class="form-control">
                                                        </div>
                                                        
                                                        <div class=" row">
                                                            <div class="form-group col-md-6">
                                                                <label> Property Type <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="property_type" id="">
                                                                    <option value="">Select Property Type</option>
                                                                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($types->id); ?>" <?php if($propertie->property_type == $types->type_name): echo 'selected'; endif; ?>><?php echo e($types->type_name); ?> - <?php echo e($types->plot($types->plot_id)->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6">
                                                                <label> Location <span class="text-danger">*</span></label>
                                                                <input type="text" value="<?php echo e($propertie->location); ?>" name="location" id="edit_checkin" class="form-control">
                                                            </div>
                            
                                                        </div>
                                                        
                            
                            
                                                        <div class="form-group">
                                                            <label> Address <span class="text-danger">*</span></label>
                                                            <textarea name="address" id="" cols="" rows="5" class="form-control"><?php echo e($propertie->address); ?></textarea>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label> Price <span class="text-danger">*</span></label>
                                                                <input type="text" value="<?php echo e($propertie->price); ?>" name="price" id="edit_checkin" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Area <span class="text-danger">*</span></label>
                                                                <input type="text" value="<?php echo e($propertie->area); ?>" name="area" id="edit_checkin" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Unit <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="unit_id" id="">
                                                                    <option value="">Select Unit</option>
                                                                    <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($area->id); ?>" <?php if($propertie->unit_id == $area->id): echo 'selected'; endif; ?>><?php echo e($area->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                            
                                                        </div>
                                                        
                            
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label>Assigned Agent <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="agency_id" id="">
                                                                    <option value="">Select Agent</option>
                                                                    <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($agent->id); ?>" <?php if($propertie->agency_id == $agent->id): echo 'selected'; endif; ?>><?php echo e($agent->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Contract <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="contract_type" id="">
                                                                    <option value="">Select Contract</option>
                                                                    <?php $__currentLoopData = $contruct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($contract->id); ?>" <?php if($propertie->contract_type == $contract->contruct_name): echo 'selected'; endif; ?>><?php echo e($contract->contruct_name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Status <span class="text-danger">*</span></label>
                                                                <select name="status" id="" class="form-control">
                                                                    <option value=""> Select Listing Status</option>
                                                                    <option value="0"  <?php if($propertie->status == '0'): echo 'selected'; endif; ?>>Sold</option>
                                                                    <option value="1" <?php if($propertie->status == '1'): echo 'selected'; endif; ?>>Active</option>
                                                                    <option value="2" <?php if($propertie->status == '2'): echo 'selected'; endif; ?>>Pending</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="form-group col-md-4">
                                                                <label> Number of Floors <span class="text-danger">*</span></label>
                                                                <input type="text" name="floor" id="edit_checkin" value="<?php echo e($propertie->floor); ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> No of Bedrooms <span class="text-danger">*</span></label>
                                                                <input type="number" name="bedroom" value="<?php echo e($propertie->bedroom); ?>" class="form-control" id="">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label> Number of Bathrooms <span class="text-danger">*</span></label>
                                                                <input type="text" name="bathroom" value="<?php echo e($propertie->bathroom); ?>" id="edit_checkin" class="form-control">
                                                            </div>
                            
                                                        </div>
                                                        
                                                        <div class=" row">                                                                
                                                            <div class="form-group col-md-8">
                                                                <p style="font-weight: 600">Amenity</p>
                                                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                                                    
                                                                    <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="<?php echo e($amenity->id); ?>" <?php if(isset($propertie->amenities) && in_array($amenity->id,$propertie->amenities)): echo 'checked'; endif; ?>  name="amenities[]" id="flexCheckChecked">
                                                                        <label class="form-check-label" style="font-weight: 500" for="flexCheckChecked">
                                                                            <?php echo e($amenity->name); ?>

                                                                        </label>
                                                                    </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                                
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
        <div class="modal custom-modal fade" id="callstore" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Property</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(url('property-store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Property Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="edit_checkin" class="form-control">
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-6">
                                    <label> Property Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="property_type" id="">
                                        <option value="">Select Property Type</option>
                                        <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($types->id); ?>"><?php echo e($types->type_name); ?> - <?php echo e($types->plot($types->plot_id)->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label> Location <span class="text-danger">*</span></label>
                                    <input type="text" name="location" id="edit_checkin" class="form-control">
                                </div>

                            </div>
                            


                            <div class="form-group">
                                <label> Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="" cols="" rows="5" class="form-control"></textarea>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label> Price <span class="text-danger">*</span></label>
                                    <input type="text" name="price" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Area <span class="text-danger">*</span></label>
                                    <input type="text" name="area" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Unit <span class="text-danger">*</span></label>
                                    <select class="form-control" name="unit_id" id="">
                                        <option value="">Select Unit</option>
                                        <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($area->id); ?>"><?php echo e($area->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            </div>
                            

                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label>Assigned Agent <span class="text-danger">*</span></label>
                                    <select class="form-control" name="agency_id" id="">
                                        <option value="">Select Agent</option>
                                        <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($agent->id); ?>"><?php echo e($agent->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contract <span class="text-danger">*</span></label>
                                    <select class="form-control" name="contract_type" id="">
                                        <option value="">Select Contract</option>
                                        <?php $__currentLoopData = $contruct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($contract->id); ?>"><?php echo e($contract->contruct_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Status <span class="text-danger">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value=""> Select Listing Status</option>
                                        <option value="0">Sold</option>
                                        <option value="1">Active</option>
                                        <option value="2">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label> Number of Floors <span class="text-danger">*</span></label>
                                    <input type="text" name="floor" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> No of Bedrooms <span class="text-danger">*</span></label>
                                    <input type="number" name="bedroom" class="form-control" id="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Number of Bathrooms <span class="text-danger">*</span></label>
                                    <input type="text" name="bathroom" id="edit_checkin" class="form-control">
                                </div>

                            </div>
                            <div class=" row">
                                <div class="form-group col-md-4">
                                    <label> Add Documents <span class="text-danger">*</span></label>
                                    <input type="file" name="document" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Add Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" id="edit_checkin" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label> Add Floor Plan <span class="text-danger">*</span></label>
                                    <input type="file" name="plan" id="edit_checkin" class="form-control">
                                </div>
                            </div>
                            <div class=" row">
                                
                                
                                <div class="form-group col-md-8">
                                    <p style="font-weight: 600">Amenity</p>
                                    <div class="d-flex gap-2 align-items-center flex-wrap">
                                        <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo e($amenity->id); ?>" name="amenities[]" id="flexCheckChecked">
                                            <label class="form-check-label" style="font-weight: 500" for="flexCheckChecked">
                                                <?php echo e($amenity->name); ?>

                                            </label>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    
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
        $(document).ready(function() {
            $('.deletebtn').on('click', function() {
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/property/property.blade.php ENDPATH**/ ?>