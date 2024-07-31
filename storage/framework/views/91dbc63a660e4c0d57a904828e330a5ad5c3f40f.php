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
    <h1 class="h3 mb-0 text-gray-800">Manage Students</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Students</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        <?php echo $__env->make('admin.student.create_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <!-- Input Group -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">All Students</h6>
            </div>
            <div class="table-responsive p-3">
              <table class="display table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Group</th>
                    <th data-sortable='false'>Edit</th>
                    <th data-sortable='false'>Delete</th>
                    <th data-sortable='false'>Update Password</th>
                  </tr>
                </thead>

                <tbody>
                  <!-- DB -->
                  <!-- sample -->
                  <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($student['student_id']); ?></td>
                    <td><?php echo e($student['student_first_name']); ?></td>
                    <td><?php echo e($student['student_last_name']); ?></td>
                    <td><?php echo e($student['student_email']); ?></td>
                    <td><?php echo e($student->group->group_name); ?></td>
                    <td><a href="<?php echo e(route('students.edit',$student['student_id'])); ?>"><i class='purple-icon fas fa-fw fa-edit'></i></a></td>
                    <td>
                        <form method="post" action="<?php echo e(route('students.destroy',$student['student_id'])); ?>">
                        <?php echo method_field("DELETE"); ?>
                        <?php echo csrf_field(); ?>
                        <button style="all:unset" type="submit"><i class='purple-icon fas fa-fw fa-trash'></i>
                        </form>
                    </td>
                    <td><a href="" class='btn btn-primary'>Edit</a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
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

</html><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/student/manageStudent.blade.php ENDPATH**/ ?>