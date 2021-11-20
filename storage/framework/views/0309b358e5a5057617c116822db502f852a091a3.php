<?php $__env->startSection('header'); ?>
        <input id="contextPath" hidden type="text" value="<?php echo e($root_path); ?>">
        <input id="loggedUserId" hidden type="text" value="<?php echo e(\Illuminate\Support\Facades\Auth::id()); ?>">

        <div class="navbar fixed-top navbar-dark app-bg-gray">
            <img class="logo" src="/images/ChNU_Small_Logo.png" alt="Logo">

            <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
                <button class="btn btn-danger" onclick="logout()">LogOut</button>
            <?php else: ?>
                <button class="btn btn-primary" onclick="login()">LogIn</button>
            <?php endif; ?>
        </div>

        <script src="/js/header.js"/>"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\voting_service\resources\views/inc/header.blade.php ENDPATH**/ ?>