<!DOCTYPE html>
<html>
<?php echo $__env->make("admin.includes.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Login Content -->
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">

                        <?php if(Session::has('message')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(Session::get('message')); ?>

                        </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('forget.password.post')); ?>" method="POST">
                            <?php echo csrf_field(); ?>


                            <div class="form-group row mb-3">




                                <div class="col-xl-6">
                                    <label class="form-control-label">Select Role<span class="text-danger ml-2">*</span></label>
                                    <select name="userType" class="form-control mb-3">
                                        <option value="">--Select User Roles--</option>
                                        <option <?php echo e((old("userType") == 'admin' ? "selected":"")); ?> value="admin">Admin</option>
                                        <option <?php echo e((old("userType") == 'teacher' ? "selected":"")); ?> value="teacher">Teacher</option>
                                        <option <?php echo e((old("userType") == 'student' ? "selected":"")); ?> value="student">Student</option>
                                    </select>
                                    <?php if($errors->has('userType')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('userType')); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <label for="email_address" class="form-control-label">E-Mail Address <span class="text-danger ml-2">*</span></label>

                                    <input type="text" id="email_address" class="form-control" name="email" value="<?php echo e(old('email')); ?>" autofocus>
                                    <?php if($errors->has('email')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                    <?php endif; ?>
                                </div>
                              
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
                                    </button>
                                </div>
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

</html><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/auth/forgetPassword.blade.php ENDPATH**/ ?>