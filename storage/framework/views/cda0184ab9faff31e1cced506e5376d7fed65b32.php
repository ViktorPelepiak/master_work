<?php $__env->startSection('title'); ?>
    Сторінка голосування
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="/css/voting.css">

    <div class="page-content app-bg-dark content flex justify-center">
        <form class="registration-login-form" method="POST" action="<?php echo e(route('vote')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <h3><?php echo e($survey->question); ?></h3>
            </div>

            <input type="hidden" id="survey_id" name="survey_id" value="<?php echo e($survey->id); ?>">
            <input type="hidden" id="email" name="email" value="<?php echo e($respondent->email); ?>">
            <input type="hidden" id="answerVariantList" value="<?php echo e($answer_variants); ?>">

            <div id="answerVariants"></div>

            <input type="hidden" id="answer" name="answer" value="-1">

            <div class="form-group">
                <button id="voteBtn" class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1" disabled>Зберегти голос</button>
            </div>
        </form>
    </div>

    <script src="/js/voting.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/voting.blade.php ENDPATH**/ ?>