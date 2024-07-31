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
        <input type="number" class="form-control <?php $__errorArgs = ['student_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="student_card" value="<?php echo e(old('student_card')); ?>">
        <span id="student_card_error" class="invalid-feedback"><?php echo e($errors->first('student_card')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control <?php $__errorArgs = ['student_first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required name="student_first_name" value="<?php echo e(old('student_first_name')); ?>">
        <span id="student_first_name_error" class="invalid-feedback"><?php echo e($errors->first('student_first_name')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control <?php $__errorArgs = ['student_last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required name="student_last_name" value="<?php echo e(old('student_last_name')); ?>">
        <span id="student_last_name_error" class="invalid-feedback"><?php echo e($errors->first('student_last_name')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control <?php $__errorArgs = ['student_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required name="student_email" value="<?php echo e(old('student_email')); ?>">
        <span id="student_email_error" class="invalid-feedback"><?php echo e($errors->first('student_email')); ?></span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control <?php $__errorArgs = ['student_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required name="student_password" value="<?php echo e(old('student_password')); ?>">
        <span id="student_password_error" class="invalid-feedback"><?php echo e($errors->first('student_password')); ?></span>
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
          <option value='<?php echo e($group->group_id); ?>'><?php echo e($group->group_name); ?></option>
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