<!-- Form Basic -->
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">Create Teachers</h6>
  create new teacher
</div>
<div class="card-body">
<form method="post" action="<?php echo e(route('teachers.store')); ?>">
<?php echo csrf_field(); ?>
    <div class="form-group row mb-3">

      <div class="col-xl-6">
        <label class="form-control-label">ID<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control <?php $__errorArgs = ['id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('id')); ?>" required name="id" >
        <span id="id_error" class="invalid-feedback"><?php echo e($errors->first('id')); ?></span>
      </div>
     
      <div class="col-xl-6">
        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('first_name')); ?>" required name="first_name" >
        <span id="first_name_error" class="invalid-feedback"><?php echo e($errors->first('first_name')); ?></span>
       
      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('last_name')); ?>" required name="last_name" >
        <span id="last_name_error" class="invalid-feedback"><?php echo e($errors->first('last_name')); ?></span>

      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Grade<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control <?php $__errorArgs = ['grade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('grade')); ?>" required name="grade" >
        <span id="grade_error" class="invalid-feedback"><?php echo e($errors->first('grade')); ?></span>

      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required name="email" >
        <span id="email_error" class="invalid-feedback"><?php echo e($errors->first('email')); ?></span>

      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('password')); ?>" required name="password" >
        <span id="password_error" class="invalid-feedback"><?php echo e($errors->first('password')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Phone No<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('phone')); ?>" name="phone" >
        <span id="phone_error" class="invalid-feedback"><?php echo e($errors->first('phone')); ?></span>
      
      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
       
        <button type="submit" id='submit' name="save" value="save" class="btn btn-primary">Save</button>
      </div>
    </div>

  </form>
</div><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/teacher/create_form.blade.php ENDPATH**/ ?>