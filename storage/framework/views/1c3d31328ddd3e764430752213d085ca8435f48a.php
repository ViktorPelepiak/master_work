<?php $__env->startSection('title'); ?>
    Перегляд голосування
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="/css/displaySurveys.css">

    <div class="page-content app-bg-dark content flex justify-center">
        <div class="global-container">
            <div class="content-block">
                <label for="question">Питання</label>
                <h3 id="question"><?php echo e($question); ?></h3>
            </div>

            <div class="content-block">
                <input id="answerVariantsInput" type="hidden" value="<?php echo e($answerVariants); ?>">
                <label for="answerVariants">Варіанти відповіді</label>
                <div id="answerVariants"></div>
            </div>

            <div class="content-block flex-container">
                <h5>Доступне від&nbsp;</h5><?php echo e($timeOfStart); ?> <h5>&nbsp;до&nbsp;</h5><?php echo e($timeOfFinish); ?>

            </div>
            <div class="content-block">
                <label for="respondents">Контакти запрошені до голоування:</label>
                <h5 id="respondents">
                    <?php $__currentLoopData = $respondents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($resp['email']); ?>;
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </h5>
            </div>
            <div class="content-block flex-container">
                <label for="respondents">Чи можливий перегляд статистики під час голосування:&nbsp;</label>
                <h5 id="respondents">
                    <?php if($reviewInProcess): ?>
                        Так
                    <?php else: ?>
                        Ні
                    <?php endif; ?>
                </h5>
            </div>
            <?php if($canReviewResults): ?>
            <div class="content-block flex-container">
                <input id="answerVariantsArray" type="hidden" value="<?php echo e($answerVariants); ?>">
                <input id="answerQuantities" type="hidden" value="<?php echo e($answerQuantities); ?>">

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <nav class="navbar fixed-bottom">
        <button class="new-survey-btn" onclick="toVotingManagementPage()"><img class="back-arrow" src="/images/arrow-left.png" alt="Logo"></button>
    </nav>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="/js/statistic.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/surveyReview.blade.php ENDPATH**/ ?>