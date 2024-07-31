<!--non-changing part-->
<?php echo $__env->make("admin.Includes.topLayout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <?php if(session('success')): ?>
  <div class="alert alert-success text-center" role="alert">
    <?php echo e(session('success')); ?>

  </div>
  <?php endif; ?>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Students</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Students</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        <!-- Form Basic -->

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Upadte A Student</h6>
          update <?php echo e($student['student_first_name']); ?> <?php echo e($student['student_last_name']); ?>

        </div>
        <div class="card-body">
          <form method="post" action="<?php echo e(route('students.update',$student)); ?>">
            <?php echo method_field("PATCH"); ?>
            <?php echo csrf_field(); ?>
            <div class="form-group row mb-3">
              <input type="hidden" name="student_id" value="<?php echo e($student->student_id); ?>">
              <div class="col-xl-6">
                <label class="form-control-label">Student Card Number<span class="text-danger ml-2">*</span></label>
                <input type="number" class="form-control <?php $__errorArgs = ['student_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="student_card" value="<?php echo e(old('student_card', $student->student_card )); ?>">
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
unset($__errorArgs, $__bag); ?>" required name="student_first_name" value="<?php echo e(old('student_first_name', $student->student_first_name )); ?>">
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
unset($__errorArgs, $__bag); ?>" required name="student_last_name" value="<?php echo e(old('student_last_name',$student->student_last_name )); ?>">
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
unset($__errorArgs, $__bag); ?>" required name="student_email" value="<?php echo e(old('student_email',$student->student_email )); ?>">
                <span id="student_email_error" class="invalid-feedback"><?php echo e($errors->first('student_email')); ?></span>
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
                  <option <?php if($student->group_id==$group->group_id): ?> selected <?php endif; ?> value='<?php echo e($group->group_id); ?>'><?php echo e($group->group_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger" id="group_id_error"><?php echo e($errors->first('group_id')); ?></span>
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-xl-6">
                <button id="update" type="submit" class="btn btn-warning">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Input Group -->

    </div>

  </div>
  <!-- Container Form -->


  <!---Container Fluid-->
</div>

<!--non-changing part-->
<?php echo $__env->make("admin.Includes.bottomLayout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {
    let updateTrElement;

    var table = $('#dataTableHover').DataTable(({
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }],
    })); // ID From dataTable with Hover
  })
</script>
</body>

</html><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/student/editStudent.blade.php ENDPATH**/ ?>