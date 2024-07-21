<!--non-changing part--> @include("teacher.Includes.topLayout")
<!--non-changing part-->

<!--changing part-->
<div class="container-fluid" id="container-wrapper">
  @if (session('errors'))
  <div class="alert alert-danger" role="alert">
    {{ session('errors')->first() }}
  </div>
  @endif
  <!-- Container Fluid-->

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <!--header-->
    <h1 class="h3 mb-0 text-gray-800">Take Attendance </h1>
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

      <!--Form Basic-->
      <div class="row">
        <!--input-Group-->
        <div class="col-lg-12">
          <!--col-->
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">All Student in Group </h6>
              <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click besides each student to take attendance!</i></h6>
            </div>
            <div class="table-responsive p-3">

              <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                  <tr>

                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    @foreach($studies as $key => $study)
                    @if(count($group)>1)
                    @if(($key+1) % count($group) == 0)
                    <th>{{date_format(new DateTime($study->session->session_date),"l Y-m-d H:i")}}</th>
                    @endif
                    @else
                    <th>{{date_format(new DateTime($study->session->session_date),"l Y-m-d H:i")}}</th>
                    @endif
                    @endforeach

                  </tr>
                </thead>
                <tbody>

                  @foreach($studies as $key => $study)
                  @if(count($group)>1)

                  @if($key < count($group)) @foreach($study->group_Teaching->group->students as $student)

                    <tr>
                      <td class="align-middle"></td>
                      <td class="align-middle">{{$student->student_first_name}}</td>
                      <td class="align-middle">{{$student->student_last_name}}</td>

                      @foreach($studies as $key =>$study)


                      @if(($key+1) % count($group) == 0)


                      <td><select style="width: auto;" name="status[{{$student->student_id}}][{{$study->session->session_date}}]" class="form-control statusController" data-study-date="{{$study->session->session_date}}" data-student-id="{{$student->student_id}}">
                          <option class="text-success" value='{{$student_status["present"]}}'>Present</option>
                          <option class="text-danger" @if($student->getMyStatusInThisDate($study->session->session_date)->status==$student_status["absent_without_justification"]) selected @endif value='{{$student_status["absent_without_justification"]}}'>Absent without justification</option>
                          <option class="text-warning" @if($student->getMyStatusInThisDate($study->session->session_date)->status==$student_status["absent_with_justification"]) selected @endif value='{{$student_status["absent_with_justification"]}}'>Absent with justification</option>
                        </select>
                      </td>

                      @endif
                      @endforeach

                    </tr>
                    @endforeach
                    @endif
                    @else
                    @foreach($study->group_Teaching->group->students as $student)


                    <tr>
                      <td class="align-middle"></td>
                      <td class="align-middle">{{$student->student_first_name}}</td>
                      <td class="align-middle">{{$student->student_last_name}}</td>

                      @foreach($studies as $key =>$study)
                      <td>
                        <select style="width: auto;" required name="status[{{$student->student_id}}][{{$study->session->session_date}}]" class="form-control statusController" data-study-date="{{$study->session->session_date}}" data-student-id="{{$student->student_id}}">
                          <option class="text-success" value='{{$student_status["present"]}}'>Present</option>
                          <option class="text-danger" @if($study->getStudentStatus($student->student_id)->pivot->status==$student_status["absent_without_justification"]) selected @endif value='{{$student_status["absent_without_justification"]}}'>Absent without justification</option>
                          <option class="text-warning" @if($study->getStudentStatus($student->student_id)->pivot->status==$student_status["absent_with_justification"]) selected @endif value='{{$student_status["absent_with_justification"]}}'>Absent with justification</option>
                        </select>

                      </td>

                      @endforeach
                    </tr>
                    @endforeach
                    @break
                    @endif
                    @endforeach
                </tbody>
              </table>

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
  <div id="formContainer" class="card mb-4">
    <!-- Form Basic -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Delete Session</h6>
      delete Session
    </div>
    <div class="card-body">
      <form action="{{route('deleteSession')}}" method="post">
        @csrf
        <div class="form-group row mb-3">
          <input type="hidden" name='is_course' value="{{count($group)>1 ? 'true' : 'false'}}">
          <div class="col-xl-6">
            <label class="form-control-label">Select A Session<span class="text-danger ml-2">*</span></label>
            <select required name="study_id" class="form-control mb-3">
              <option value='null'>--Select Session--</option>
              @foreach($studies as $key => $study)
              @if(count($group)>1)
              @if(($key+1) % count($group) == 0)
              <option value="{{$study->study_id}}">{{date_format(new DateTime($study->session->session_date),"l Y-m-d H:i")}}</option>
              @endif
              @else
              <option value="{{$study->study_id}}">{{date_format(new DateTime($study->session->session_date),"l Y-m-d H:i")}}</option>
              @endif
              @endforeach
            </select>
            <span class="text-danger" id="study_id_error"></span>
          </div>
        </div>
        <div class="form-group row mb-3">
          <div class="col-xl-1">
            <input type="submit" value="Delete Session" class="btn btn-primary">
          </div>
        </div>


      </form>
    </div>
  </div>
</div><!-- Container Fluid-end-->
<!--changing part-->

<!--non-changing part--> @include("teacher.Includes/bottomLayout")
<!--non-changing part-->
<script>
  $(document).ready(function() {
    $('.statusController').each(function() {
      this.className = " form-control statusController " + $("option:selected", this).attr('class')
    });
    var table = $('#dataTableHover').DataTable({
      columnDefs: [{
        searchable: false,
        orderable: false,
        targets: 0,
      }, ],
      order: [
        [1, 'asc']
      ],
    });

    table.on('order.dt search.dt', function() {
      let i = 1;

      table.cells(null, 0, {
        search: 'applied',
        order: 'applied'
      }).every(function(cell) {
        this.data(i++);
      });
    }).draw();

    $(document).on('change', '.statusController', function() {
      let selectTag = this;
      let study_date = $(this).attr('data-study-date')
      let student_id = $(this).attr('data-student-id')
      if (this.value == 2) {
        $.post("{{route('deleteAbsence')}}", {

          '_token': "{{csrf_token()}}",
          'status': this.value,
          'study_date': study_date,
          'student_id': student_id,
        }, function(response) {
          if (response.status) {
            selectTag.className = " form-control statusController " + $("option:selected", selectTag).attr('class')


          } else {
            console.log(response);

          }


        });

      } else {

        $.post("{{route('updateAbsenceStatus')}}", {
          '_token': "{{csrf_token()}}",
          'status': this.value,
          'study_date': study_date,
          'student_id': student_id,
        }, function(response) {
          if (response.status) {
            selectTag.className = " form-control statusController " + $("option:selected", selectTag).attr('class')

          } else {
            console.log(response);
          }

        });
      }
    });


  })
</script>