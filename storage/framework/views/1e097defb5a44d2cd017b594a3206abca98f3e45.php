<!DOCTYPE html>
<html>
<?php echo $__env->make("admin.includes.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<body class="bg-gradient-login">
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reset Password</div>
                        <div class="card-body">

                            <form action="<?php echo e(route('reset.password.post')); ?>" method="POST">
                                <?php if($errors->has('msg')): ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?php echo e($errors->first('msg')); ?>

                                </div>
                                <?php endif; ?>



                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                                <input type="hidden" name="userType" value="<?php echo e($userType); ?>">

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" value='<?php echo e(old("email")); ?>' required autofocus>
                                        <?php if($errors->has('email')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required autofocus>
                                        <?php if($errors->has('password')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                        <?php if($errors->has('password_confirmation')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php echo $__env->make("admin.Includes.ScriptsCall", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/auth/forgetPasswordLink.blade.php ENDPATH**/ ?>