<?php $__env->startSection('title'); ?>
    Створення голосування
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="/css/newSurvey.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content app-bg-dark content flex justify-center">
        <form class="survey-form" method="POST" action="/surveys/create">
            <?php echo csrf_field(); ?>

            <input id="userId" name="userId" hidden type="text" value="<?php echo e(\Illuminate\Support\Facades\Auth::id()); ?>">

            <label for="question" class="survey-form-label">Питання до голосування</label>
            <textarea name="question" id="question" class="form-control" placeholder="Питання" onchange="validateForm()"></textarea>
            <label for="question" id="questionRequirement" class="required" style="display: none;">Це поле обов'язкове до заповнення</label>

            <input id="answerVariantList" name="answerVariantList" type="hidden">

            <label for="answerVariants" class="survey-form-label">Варіанти відповіді</label>
            <div id="answerVariants"></div>
            <div style="display: flex;">
                <button type="button" class="btn btn-success btn-new-answer-variant" data-toggle="modal" onclick="prepareAddAnswerVariantModal()" data-target="#addAnswerModal">
                    Додати варіант відповіді
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6" style="padding-left: 0;">
                    <label for="datatime_from" class="survey-form-label">Дата і час початку голосування</label>
                    <input id="datatime_from" name="datatime_from" class="form-control" type="datetime-local" onchange="validateForm()">
                    <label for="datatime_from" id="datatime_fromRequirement" class="required" style="display: none;">Це поле обов'язкове до заповнення</label>
                </div>
                <div class="p-6" style="padding-right: 0;">
                    <label for="datatime_to" class="survey-form-label">Дата і час завершення голосування</label>
                    <input id="datatime_to" name="datatime_to" class="form-control" type="datetime-local" onchange="validateForm()">
                    <label for="datatime_to" id="datatime_toRequirement" class="required" style="display: none;">Це поле обов'язкове до заповнення</label>
                </div>
            </div>

            <div class="form-check">
                <input id="reviewInProgressInput" name="reviewInProgressInput" type="text" hidden value="false">
                <input class="form-check-input" type="checkbox" value="" id="reviewInProgress" name="reviewInProgress" onclick="switchReviewInProgress()">
                <label class="form-check-label" for="reviewInProgress">
                    Чи можна переглядати статистику в процесі голосування?
                </label>
            </div>

            <label for="respondents" class="survey-form-label">Респонденти</label>
            <textarea name="respondents" id="respondents" class="form-control" onchange="validateForm()"></textarea>
            <label for="respondents" id="respondentsRequirement" class="required" style="display: none;">Поле порожнє або одина чи декілька адрес вказані некоректно</label>

            <button id="saveVoting" class="btn btn-primary new-survey-btn" type="submit" disabled>Створити голосування</button>
        </form>

        <!-- Modal -->
        <div class="modal" id="addAnswerModal" tabindex="-1" role="dialog" aria-labelledby="addAnswerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnswerModalLabel">Додати варіант відповіді</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="newAnswerVariantInput" type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-modal btn-secondary" data-dismiss="modal">Скасувати</button>
                        <button type="button" class="btn btn-modal btn-primary" data-dismiss="modal" onclick="addAnswerVariant()">Додати варіант</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" id="editAnswerModal" tabindex="-1" role="dialog" aria-labelledby="editAnswerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAnswerModalLabel">Редагувати варіант відповіді</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="index" type="hidden">
                        <input id="editAnswerVariantInput" type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-modal btn-secondary" data-dismiss="modal">Скасувати</button>
                        <button type="button" class="btn btn-modal btn-primary" data-dismiss="modal" onclick="editAnswerVariant()">Зберегти</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="/js/newSurvey.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/addNewSurvey.blade.php ENDPATH**/ ?>