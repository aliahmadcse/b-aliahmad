

<?php $__env->startSection('title','Admin'); ?>

<?php $__env->startSection('content'); ?>

<admin-navbar :project_categories="<?php echo e($project_categories); ?>"></admin-navbar>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\b-aliahmad\resources\views\admin\index.blade.php ENDPATH**/ ?>