<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leads')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function() {
            $('#change-pipeline').submit();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Lead')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end d-flex align-items-center gap-1">
        <form id="stage" action="<?php echo e(url('leads/list')); ?>" x-data="{ query:'<?php echo e(request()->query('stage')); ?>' }">
            <select name="stage" x-model="query" x-on:change="document.querySelector('#stage').submit()"
                class=" form-control-sm" id="">
                <option value="all">All Stage</option>
                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($stage->name)); ?>" ><?php echo e($stage->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            
        </form>
        <form id="filter" action="<?php echo e(url('leads/list')); ?>" x-data="{ query:'<?php echo e(request()->query('filter')); ?>' }">
            <select name="filter" x-model="query" x-on:change="document.querySelector('#filter').submit()"
                class=" form-control-sm" id="">
                <option value="all">All Leads</option>
                <option value="todays" :selected="query === 'todays'">Today's Leads</option>
                <option value="upcoming" :selected="query === 'upcoming'">Upcoming Leads</option>
                <option value="past" :selected="query === 'past'">Past Lead</option>
            </select>
            
        </form>
        <a href="<?php echo e(route('leads.index')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Kanban View')); ?>"
            class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>
        <a href="#" data-size="lg" data-url="<?php echo e(route('leads.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" title="<?php echo e(__('Create New User')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Lead Stage')); ?></th>
                                    <th><?php echo e(__('Lead Source')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('TIMESTAMP')); ?></th>
                                    
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($leads) > 0): ?>
                                    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($lead->name); ?></td>
                                            <td><?php echo e($lead->subject); ?></td>
                                            <td><?php echo e(\App\Models\Pipeline::findOrFail($lead->pipeline_id)->name); ?>

                                            </td>
                                            <td><?php echo e(\App\Models\Source::findOrFail($lead->source)->name); ?>

                                            <td><?php echo e(\App\Models\LeadStage::findOrFail($lead->stage_id)->name); ?>

                                            </td>
                                            <td><?php echo e(Carbon\Carbon::parse($lead->date)->format('d-M-Y')); ?></td>
                                            
                                            <?php if(Auth::user()->type != 'client'): ?>
                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view lead')): ?>
                                                            <?php if($lead->is_active): ?>
                                                                <div class="action-btn bg-warning ms-2">
                                                                    <a href="<?php echo e(route('leads.show', $lead->id)); ?>"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-size="xl" data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('View')); ?>"
                                                                        data-title="<?php echo e(__('Lead Detail')); ?>">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                    data-url="<?php echo e(route('leads.edit', $lead->id)); ?>"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                    data-title="<?php echo e(__('Lead Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['leads.destroy', $lead->id],
                                                                    'id' => 'delete-form-' . $lead->id,
                                                                ]); ?>

                                                                <a href="#"
                                                                    class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                        class="ti ti-trash text-white"></i></a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                <?php endif; ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="mailto:admin@ecspvt.com" class="mx-3 btn btn-sm  align-items-center "
                                                        data-bs-toggle="tooltip" title="<?php echo e(__('Mail')); ?>"><i
                                                            class="ti ti-mail text-white"></i></a>
                                                </div>
                                                <div class="action-btn bg-danger ms-2">
                                                    <a href="tel:8910346789" class="mx-3 btn btn-sm  align-items-center "
                                                        data-bs-toggle="tooltip" title="<?php echo e(__('Call')); ?>"><i
                                                            class="ti ti-phone text-white"></i></a>
                                                </div>
                                                </span>
                                                </td>
                                        <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                    </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script></script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\construction\resources\views/leads/list.blade.php ENDPATH**/ ?>