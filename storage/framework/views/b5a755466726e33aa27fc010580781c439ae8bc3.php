<!--non-changing part-->
<?php echo $__env->make("admin.Includes.topLayout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--changing part-->
<div class="container-fluid" id="container-wrapper">
  <!-- Container Fluid-->
  <!--changing part-->
  <?php if(session('success')): ?>
  <div class="alert alert-success text-center" role="alert">
    <?php echo e(session('success')); ?>

  </div>
  <?php endif; ?>
  <?php if(session('errors')): ?>
  <div class="alert alert-danger text-center" role="alert">
    <?php echo e(session('errors')->first()); ?>

  </div>
  <?php endif; ?>
  <!-- Container Fluid-->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <!--header-->
    <h1 class="h3 mb-0 text-gray-800">Display Justifications</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Display Justifications</li>
    </ol>
    
  </div>

  <!--header-end-->

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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Group</th>
                <th>Seen</th>
                <th>View</th>
              </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $justification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($justification->student->student_first_name); ?></td>
                <td><?php echo e($justification->student->student_last_name); ?></td>
                <td><?php echo e($justification->student->student_email); ?></td>
                <td><?php echo e($justification->student->group_id); ?></td>
                <td><?php if($justification->justification_status): ?> <?php echo e('Yes'); ?> <?php else: ?> <?php echo e('No'); ?> <?php endif; ?></td>
                <td><button data-justification-src='<?php echo e($justification->img_path); ?>' data-student-id="<?php echo e($justification->student->student_id); ?>" data-justification-id="<?php echo e($justification->justification_id); ?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btn">Open</button></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
        <div class='py-3 px-3'>
          <form action="<?php echo e(route('deleteJustifications')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="submit" id="deleteButton" value='Clear All The Justifications' class="btn btn-danger">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->
  <div class="container">
    <!-- Trigger the modal with a button -->
    <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <embed src="" frameborder="0" width="100%" height="550px" id="src_file">
            <form action='<?php echo e(route("decide")); ?>' method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-footer">
                <div class="col-sm-6" id="simple-date4">
                  <div class="input-daterange form-group input-group">
                    <input type="text" class="input-sm form-control" name="start_at" value="2022-11-29" id="start_at">
                    <div class="input-group-prepend">
                      <span class="input-group-text">to</span>
                    </div>
                    <input type="text" class="input-sm form-control" name="end_at" value="2022-11-30" id="end_at">
                  </div>
                </div>
                <input type="hidden" name='student_id' value='' id="student_id">
                <input type="hidden" name='justification_id' value='' id="justification_id">
                <button type="submit" class="col-sm-3 form-group btn btn-outline-primary " name="decide" value="refuse">Deny</button>
                <button type="submit"  class="col-sm-3 form-group btn btn-primary " name="decide" value="accepte">Approve</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div><!-- Container-Fluid-end-->

<!--changing part-->
<?php echo $__env->make("admin.Includes.bottomLayout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--non-changing part-->

<script>
  $(document).ready(function() {
    var allData={}
    var table = $('#dataTableHover').DataTable({
      order: [
        [4, 'asc']
      ],
    }); // ID From dataTable with Hover
    $(document).on('click', '#btn', function() {
      justification_src = $(this).attr("data-justification-src");
      student_id = $(this).attr("data-student-id");
      justification_id = $(this).attr("data-justification-id");
      $('#src_file').attr("src", `<?php echo e(asset('${justification_src}')); ?>`);
      $('#student_id').attr("value",student_id );
      $('#justification_id').attr("value",justification_id );
    })

    // $(document).on('click', '.decision', function() {
    //   decision=$(this).attr("value")
    //   $.each($('form').serializeArray(), function(i, field) {
    //     allData[field.name] = field.value;
    //   });
    //   allData['decision'] = decision;

    //   $.post("<?php echo e(route('decide')); ?>", {
    //     '_token': "<?php echo e(csrf_token()); ?>",
    //     'data': allData
    //   }, function(response) {
    //     console.log(response);
    //   })
    // })

  })
</script><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/justification.blade.php ENDPATH**/ ?>