<!DOCTYPE html>
<html>
<?php echo $__env->make("admin.includes.head", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body id="page-top">
<div class="modal fade" id="confirmModal" style="display: none; z-index: 1050;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="confirmMessage">
        </div>
        <div id='deatails'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="confirmCancel">Close</button>
          <button type="button" class="btn btn-danger" id="confirmOk">Delete</button>
        </div>
      </div>
    </div>
  </div>


  <div id="wrapper">
    <!--wrapper-->
    <!-- Sidebar -->
    <?php echo $__env->make("admin.Includes.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!--content-wrapper-->
      <div id="content">
        <!--content-->
        <!-- TopBar -->
        <?php echo $__env->make("admin.Includes.topbar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Topbar --><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/Includes/topLayout.blade.php ENDPATH**/ ?>