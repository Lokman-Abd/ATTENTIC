<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!--end-->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/ruang-admin.min.js')); ?>"></script>
<!-- Page level plugins -->
<script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js')); ?>"></script> 
<script src="<?php echo e(asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/clock-picker/clockpicker.js')); ?>"></script>

<!-- Page level custom scripts -->
<script>
    // $(document).ready(function () {
    //     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    // });    
</script> 
<!-- Page level custom scripts -->
<!-- Bootstrap Datepicker /Clockpicker -->
<script>
    // $(document).ready(function () {
    //   $('#simple-date1 .date').datepicker({
    //     format: 'dd/mm/yyyy',
    //     todayBtn: 'linked',
    //     todayHighlight: true,
    //     autoclose: true,        
    //   });
    $('#simple-date4 .input-daterange').datepicker({        
        format: 'yyyy-mm-dd',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });   
      // $('#clockPicker1').clockpicker({
      //   donetext: 'Done',
      //   autoclose: true
      // }); 
    //   $('#clockPicker2 .clockpicker').clockpicker({
    //     autoclose: true,
    //     // twelvehour: true,
    //     twelvehour: false,
    //     placement: 'top',
    //   });
    // });
</script><?php /**PATH C:\Users\Lokmane\Desktop\example-app\resources\views/admin/Includes/ScriptsCall.blade.php ENDPATH**/ ?>