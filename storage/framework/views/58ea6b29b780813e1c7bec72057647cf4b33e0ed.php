

<?php $__env->startSection('title','About'); ?>

<?php $__env->startSection('content'); ?>
<about-section :user="<?php echo e($user); ?>"></about-section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\b-aliahmad\resources\views\about.blade.php ENDPATH**/ ?>