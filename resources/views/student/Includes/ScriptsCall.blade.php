<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!--end-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/ruang-admin.min.js')}}"></script>
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Bootstrap Datepicker /Clockpicker -->
<script src="{{asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('vendor/clock-picker/clockpicker.js')}}"></script>
<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        $('#simple-date4 .input-daterange').datepicker({        
        format: 'yyyy-mm-dd',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });    
    });
</script>



 

