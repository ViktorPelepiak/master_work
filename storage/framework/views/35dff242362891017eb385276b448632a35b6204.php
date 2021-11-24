<?php $__env->startSection('title'); ?>
    Інформаційна сторінка
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content app-bg-dark content flex justify-center">
        <h1><?php echo e($errorMessage); ?></h1>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/error.blade.php ENDPATH**/ ?>