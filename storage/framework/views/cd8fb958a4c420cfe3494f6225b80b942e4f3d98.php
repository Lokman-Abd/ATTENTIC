<!--non-changing part-->


<?php echo $__env->make($guard.".Includes.topLayout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
<?php if(session('success')): ?>
  <div class="alert alert-success text-center" role="alert">
    <?php echo e(session('success')); ?>

  </div>
  <?php endif; ?>
  <!-- Container Form --> 
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Profile</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('login')); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Profile</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">
      <div id="formContainer" class="card mb-4">
        <!-- Form Basic -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Update Password </h6>
          update your password
        </div>
        <div class="card-body">
          <form method="post" action='<?php echo e(route("postUpdatePassword")); ?>'>
            <?php echo csrf_field(); ?>
            <div class="form-group row mb-3">
              <div class="col-xl-6">
                <label class="form-control-label">Current Password<span class="text-danger ml-2">*</span></label>
                <input type="password" class="form-control" required name="<?php echo e('current_password'); ?>" value="<?php echo e(old('current_password')); ?>">
                <?php if($errors->has('current_password')): ?>
                <span class="text-danger"><?php echo e($errors->first('current_password')); ?></span>
                <?php endif; ?>
              </div>
              <div class="col-xl-6">
                <label class="form-control-label">New Password<span class="text-danger ml-2">*</span></label>
                <input type="password" class="form-control" required name="<?php echo e('new_password'); ?>" value="<?php echo e(old('new_password')); ?>">
                <?php if($errors->has('new_password')): ?>

                <span class="text-danger"><?php echo e($errors->first('new_password')); ?></span>
                <?php endif; ?>
              </div>
              <div class="col-xl-6">
                <label class="form-control-label">confirm password<span class="text-danger ml-2">*</span></label>
                <input type="password" class="form-control" required name="<?php echo e('new_password_confirmation'); ?>" value="<?php echo e(old('new_password_confirmation')); ?>">

              </div>
            </div>
            <div class="form-group mb-3">
              <button type="submit" id='submit' class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
      <!-- Input Group -->

    </div>
  </div>
</div>
<!-- Container Form -->


<!---Container Fluid-->


<!--non-changing part-->
<?php echo $__env->make("admin.Includes.bottomLayout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/update_password.blade.php ENDPATH**/ ?>