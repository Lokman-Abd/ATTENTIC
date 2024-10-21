<!-- Form Basic -->
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">Create Students</h6>
  create new student
</div>
<div class="card-body">
  <form method="post" action="<?php echo e(route('students.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
        <label class="form-control-label">Student Card Number<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control <?php $__errorArgs = ['card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="card_number" value="<?php echo e(old('card_number')); ?>">
        <span id="card_number_error" class="invalid-feedback"><?php echo e($errors->first('card_number')); ?></span>
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
unset($__errorArgs, $__bag); ?>" required name="first_name" value="<?php echo e(old('first_name')); ?>">
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
unset($__errorArgs, $__bag); ?>" required name="last_name" value="<?php echo e(old('last_name')); ?>">
        <span id="last_name_error" class="invalid-feedback"><?php echo e($errors->first('last_name')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required name="email" value="<?php echo e(old('email')); ?>">
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
unset($__errorArgs, $__bag); ?>" required name="password" value="<?php echo e(old('password')); ?>">
        <span id="password_error" class="invalid-feedback"><?php echo e($errors->first('password')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Select Group<span class="text-danger ml-2">*</span></label>
        <select required name="group_id" class="form-control mb-3 <?php $__errorArgs = ['group_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
          <option>--Select Group--</option>
          <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value='<?php echo e($group->id); ?>'><?php echo e($group->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <span class="text-danger" id="group_id_error"><?php echo e($errors->first('group_id')); ?></span>
      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">

        <button id='submit' name="save" value="save" class="btn btn-primary">Save</button>
      </div>
    </div>

  </form>
</div><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/student/create_form.blade.php ENDPATH**/ ?>