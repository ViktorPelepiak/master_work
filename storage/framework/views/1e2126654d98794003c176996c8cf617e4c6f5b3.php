<?php $__env->startSection('title'); ?>
    Вхід
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content app-bg-dark content flex justify-center">
    <form class="registration-login-form" method="POST" action="<?php echo e(route('user.login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="email" class="col-form-label-lg">Ваш email</label>
            <input class="form-control" id="email" name="email" type="email" value="" placeholder="Email">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\voting_service\resources\views/login.blade.php ENDPATH**/ ?>