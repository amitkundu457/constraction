<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('pipelines.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'pipelines.index' ) ? ' active' : ''); ?>"><?php echo e(__('Lead Type')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('lead_stages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'lead_stages.index' ) ? 'active' : ''); ?>"><?php echo e(__('Lead Stages')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        

        <a href="<?php echo e(route('sources.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'sources.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Sources')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        

        

    </div>
</div>
<?php /**PATH E:\laragon\www\construction\resources\views/layouts/crm_setup.blade.php ENDPATH**/ ?>