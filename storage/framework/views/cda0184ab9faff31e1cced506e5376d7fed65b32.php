<?php $__env->startSection('title'); ?>
    Login
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>


    <div class="page-content app-bg-dark content flex justify-center">
        <form class="registration-login-form" method="POST" action="<?php echo e(route('vote')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <h3><?php echo e($survey->question); ?></h3>
            </div>

            <input type="hidden" id="survey_id" name="survey_id" value="<?php echo e($survey->id); ?>">
            <input type="hidden" id="email" name="email" value="<?php echo e($respondent->email); ?>">

            <div class="form-group">
                <input id="answer_yes" name="answer" type="radio" value="" onclick="changeValue()">
                <label for="answer_yes" class="col-form-label-lg">За</label>
            </div>

            <div class="form-group">
                <input id="answer_no" name="answer" type="radio" value="" onclick="changeValue()">
                <label for="answer_no" class="col-form-label-lg">Проти</label>
            </div>

            <input type="hidden" id="answer" name="answer" value="NOT_VOTED">

            <div class="form-group">
                <button class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1">Увійти</button>
            </div>
        </form>
    </div>

    <script src="/js/voting.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/voting.blade.php ENDPATH**/ ?>