<!--non-changing part--> @include("teacher.Includes.topLayout")
<!--non-changing part-->

<!--changing part-->
<div class="container-fluid" id="container-wrapper">
  <!-- Container Fluid-->

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <!--header-->
    <h1 class="h3 mb-0 text-gray-800">Take Attendance : {{date_format(new DateTime($session->session_date),"l Y-m-d H:i")}} </h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Take attendance</li>
    </ol>
  </div>
  <!--header-end-->

  <div class="row">
    <!--Row-->
    <div class="col-lg-12">
      <!--Col-->
      <form method="post" action='{{route("setAbsence")}}'>
        @foreach($studies as $study)
        <input type="hidden" name="study_ids[]" value="{{$study->study_id}}">
        @endforeach
        @csrf
        <!--Form Basic-->
        <div class="row">
          <!--input-Group-->
          <div class="col-lg-12">
            <!--col-->
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Student in Group {{implode(",", $group_ids)}}</h6>
                <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click besides each student to take attendance!</i></h6>
              </div>
              <div class="table-responsive p-3">

                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-light">
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Check</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($studies as $study)

                    @foreach($study->group_Teaching->group->students as $student)
                    <tr>
                      <td class="align-middle"></td>
                      <td class="align-middle">{{$student->student_first_name}}</td>
                      <td class="align-middle">{{$student->student_last_name}}</td>
                      <input type="hidden" name="study_id_of_student[{{$study->study_id}}][]" value="{{$student->student_id}}">
                      <!-- <td class="align-middle"><input name='' type='checkbox' value="" class='form-control'></td> -->
                      <td><select required name="status[{{$student->student_id}}]" class="form-control statusController">
                          <option selected class="text-success" value='{{$student_status["present"]}}' selected>Present</option>
                          <option class="text-danger" value='{{$student_status["absent_without_justification"]}}'>Absent without justification</option>
                          <option class="text-warning" value='{{$student_status["absent_with_justification"]}}'>Absent with justification</option>
                        </select>
                      </td>
                    </tr>

                    @endforeach
                    @endforeach

                  </tbody>
                </table><br>
                <input type="submit" name="save" value='Submit Attendance' class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
<!--col-end-->
</div>
<!--input-Group-end-->
</div>
<!--Col-end-->
</div>
<!--Row-end-->
</div><!-- Container Fluid-end-->
<!--changing part-->

<!--non-changing part--> @include("teacher.Includes/bottomLayout")
<!--non-changing part-->
<script>
  $(document).ready(function() {
    $('.statusController').each(function() {
      this.className = " form-control statusController " + $("option:selected", this).attr('class')
    });
    table = $('#dataTableHover').DataTable(({
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }],
      paging: false,
      searching: false
    }));
    $(document).on('change', '.statusController', function() {
      this.className = " form-control statusController " + $("option:selected", this).attr('class')
    })
  })
</script>