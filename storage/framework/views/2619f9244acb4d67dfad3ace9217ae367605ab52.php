<?php $__env->startSection('title'); ?>
    Головна сторінка
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="/css/mainPage.css">
<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="page-content app-bg-dark content flex justify-center">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <img class="big-logo" src="/images/ChNU_Logo.png" alt="Logo">
                    </div>

                    <div class="p-6">
                        <div style="display: flex; align-items: center; height: 100%; min-width: 22rem;">
                        <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                            <button class="btn btn-primary" onclick="mySurveys()">Мої голосування</button>
                        <?php else: ?>
                            <div class="flex justify-center" style="width: 100%">
                                <form class="registration-login-form" style="width: 100%; margin-right: 4rem;" method="POST" action="<?php echo e(route('user.loginFromMainPage')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label-lg">Ваш email</label>
                                        <input class="form-control" id="email" name="email" type="text" value="" placeholder="Email">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label-lg">Пароль</label>
                                        <input class="form-control" id="password" name="password" type="password" value="" placeholder="Пароль">
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1">Увійти</button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/welcome.blade.php ENDPATH**/ ?>
