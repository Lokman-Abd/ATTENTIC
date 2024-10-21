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
    <h1 class="h3 mb-0 text-gray-800">Manage Teachers</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Teachers</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        <?php echo $__env->make('admin.teacher.create_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
      <!-- Input Group -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">All Teachers</h6>
            </div>
            <div class="table-responsive p-3">
              <table class="display table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Grade</th>
                    <th>Email </th>
                    <th>Phone </th>

                    <th data-sortable='false'>Edit</th>
                    <th data-sortable='false'>Delete</th>
                    <th data-sortable='false'>Update Password</th>
                  </tr>
                </thead>

                <tbody>
                  <!-- DB -->
                  <!-- sample -->
                  <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($teacher['id']); ?></td>
                    <td><?php echo e($teacher['first_name']); ?></td>
                    <td><?php echo e($teacher['last_name']); ?></td>
                    <td><?php echo e($teacher['grade']); ?></td>
                    <td><?php echo e($teacher['email']); ?></td>
                    <td><?php echo e($teacher['phone']); ?></td>


                    <td><i id='editButton' data-teacher-id="<?php echo e($teacher->id); ?>" class='purple-icon fas fa-fw fa-edit'></i></td>
                    <td><i id='deleteButton' data-teacher-id="<?php echo e($teacher->id); ?>" data-teacher-full_name="<?php echo e($teacher['first_name']); ?>   <?php echo e($teacher['last_name']); ?>" data-toggle="modal" data-target="#exampleModal" class='purple-icon fas fa-fw fa-trash'></i></td>
                    <td><a href="<?php echo e(route('teachers.show',$teacher->id)); ?>" class='btn btn-primary'>Edit</a></td>
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

</html><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/teacher/manageTeacher.blade.php ENDPATH**/ ?>