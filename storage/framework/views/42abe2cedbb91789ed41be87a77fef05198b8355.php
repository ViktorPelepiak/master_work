<?php $__env->startSection('title'); ?>
    New Survey
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="/css/newSurvey.css">

    <div class="page-content app-bg-dark content flex justify-center">
        <form class="survey-form" method="POST" action="/surveys/create">
            <?php echo csrf_field(); ?>

            <input id="userId" name="userId" hidden type="text" value="<?php echo e(\Illuminate\Support\Facades\Auth::id()); ?>">

            <label for="question" class="survey-form-label">Питання до голосування</label>
            <textarea name="question" id="question" class="form-control" placeholder="Питання"></textarea>

            <label for="datatime_from" class="survey-form-label">Дата і час початку голосування</label>
            <input id="datatime_from" name="datatime_from" class="form-control" type="datetime-local">

            <label for="datatime_to" class="survey-form-label">Дата і час завершення голосування</label>
            <input id="datatime_to" name="datatime_to" class="form-control" type="datetime-local">

            <div class="form-check">
                <input id="reviewInProgressInput" name="reviewInProgressInput" type="text" hidden value="false">
                <input class="form-check-input" type="checkbox" value="" id="reviewInProgress" name="reviewInProgress" onclick="switchReviewInProgress()">
                <label class="form-check-label" for="reviewInProgress">
                    Чи можна переглядати статистику в процесі голосування?
                </label>
            </div>

            <label for="respondents" class="survey-form-label">Респонденти</label>
            <textarea name="respondents" id="respondents" class="form-control"></textarea>

            <button class="btn btn-primary new-survey-btn" type="submit">Створити Опитування</button>
        </form>

    </div>

    <script src="/js/newSurvey.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/addNewSurvey.blade.php ENDPATH**/ ?>