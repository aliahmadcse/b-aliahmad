

<?php $__env->startSection('title','Portfolio'); ?>

<?php $__env->startSection('content'); ?>

<display-projects :project_categories="<?php echo e($project_categories); ?>"></display-projects>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\aliahmad\resources\views\portfolio.blade.php ENDPATH**/ ?>