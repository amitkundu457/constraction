<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('equipment.type.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'equipment.type.index' ) ? ' active' : ''); ?>"><?php echo e(__('Types')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('equipment.manufacturer.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'equipment.manufacturer.index' ) ? 'active' : ''); ?>"><?php echo e(__('Manufacturer')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('equipment.condition.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'equipment.condition.index' ) ? ' active' : ''); ?>"><?php echo e(__('Condition')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        

    </div>
</div>
<?php /**PATH E:\laragon\www\construction\resources\views/layouts/equipment_setup.blade.php ENDPATH**/ ?>