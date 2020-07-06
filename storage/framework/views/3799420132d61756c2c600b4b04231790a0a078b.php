

<?php $__env->startSection('title','Blog'); ?>

<?php $__env->startSection('content'); ?>
<blog-nav></blog-nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\aliahmad\resources\views\blog.blade.php ENDPATH**/ ?>