<!--non-changing part-->
@include("teacher.Includes.topLayout")

<!--changing part-->
<div class="container-fluid" id="container-wrapper">
  <!-- Container Fluid-->

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <!--header-->
    <h1 class="h3 mb-0 text-gray-800">Create Session</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create Session</li>
    </ol>
  </div>
  <!--header-end-->

  <div class="row">
    <!--Row-->
    <div class="col-lg-12">
      <!--Col-->

      <!--Form Basic-->
      @if (session('errors'))
      <div class="alert alert-danger" role="alert">
        {{ session('errors')->first() }}
      </div>
      @endif
      <div class="row">
        <!--input-Group-->
        <div class="col-lg-12">
          <!--col-->
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">All Session</h6>
              <h6 class="m-0 font-weight-bold text-danger">Note: <i>How to use!</i></h6>
            </div>
            <div class="table-responsive p-3">
              <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                  <tr>
                    <th>speciality</th>
                    <th>Groupe</th>
                    <th>Module</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>Create</th>
                    <th>View</th>

                  </tr>
                </thead>
                <tbody>
                  <!-- we have to change teachTyping -->
                  @foreach ($teachings as $teaching)
                  @foreach ($teaching->teachGroup as $group)

                  @if ($teaching->typing->type->type_id==$course_id)
                  <tr>
                    <td class="align-middle">TI</td>
                    <td class="align-middle">All</td>
                    <td class="align-middle">{{$teaching->typing->module->short_cut}}</td>
                    <td class="align-middle">{{$teaching->typing->type->type}}</td>
                    <form action="{{route('storeStudy')}}" method="post">
                      @foreach($all_groups as $group)
                      <input type="hidden" name="group_ids[]" value="{{$group}}">
                      @endforeach
                      <input type="hidden" name="teaching_id" value="{{$teaching->teaching_id}}">
                      @csrf
                      <td><input type="date" class="form-control w-100 " value="{{date('Y-m-d')}}" name="session_date" placeholder="SessuinDate"></td>
                      <td>
                        <div class="input-group bootstrap-timepicker timepicker w-100 input_min_width">
                          <input id="timepicker" value="{{date('H')}}" name='session_time' type="text" class="form-control w-25">
                          <div class="input-group-append">
                            <span class="input-group-addon input-group-text">
                              <i class="fas fa-clock"></i></span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <input type="submit" value="Create" class="btn btn-primary">
                      </td>
                      <td>
                        <a href="{{route('viewAttendance',['module'=>$teaching->typing->module->short_cut,'type'=>$teaching->typing->type->type,'group'=>'All'])}}" class="btn btn-info">View Attendance</a>
                      </td>
                    </form>
                  </tr>
                  @break
                  @endif

                  <tr>
                    <td class="align-middle">TI</td>
                    <td class="align-middle">{{$group->group_id}}</td>
                    <td class="align-middle">{{$teaching->typing->module->short_cut}}</td>
                    <td class="align-middle">{{$teaching->typing->type->type}}</td>
                    <form action="{{route('storeStudy')}}" method="post">
                      <input type="hidden" name="group_ids[]" value="{{$group->group_id}}">
                      <input type="hidden" name="teaching_id" value="{{$teaching->teaching_id}}">
                      @csrf
                      <td>
                        <input type="date" class="form-control w-100 " value="{{date('Y-m-d')}}" name="session_date">
                      </td>
                      <td>
                        <div class="input-group bootstrap-timepicker timepicker w-100 input_min_width">
                          <input id="timepicker" value="{{ date('H')}}" name='session_time' type="text" class="form-control w-25">
                          <div class="input-group-append">
                            <span class="input-group-addon input-group-text">
                              <i class="fas fa-clock"></i></span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <input type="submit" value="Create" class="btn btn-primary" data-group-id="{{$group->group_id}}" data-teaching-id="{{$teaching->teaching_id}}">
                      </td>
                      <td>
                        <a href="{{route('viewAttendance',['module'=>$teaching->typing->module->short_cut,'type'=>$teaching->typing->type->type,'group'=>$group->group_id])}}" class="btn btn-info">View Attendance</a>
                      </td>
                    </form>
                  </tr>

                  @endforeach
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>

        </div>
        <!--col-end-->
      </div>
      <!--input-Group-end-->
     

      <!--Form Basic-end-->
    </div>
    <!--Col-end-->
  </div>
  <!--Row-end-->
</div><!-- Container Fluid end-->
<!--changing part-->

@include("teacher.Includes.bottomLayout")

<script>
  $(document).ready(function() {

    $('input[name="session_time"]').timepicker({
      defaultTime: 'value',
      minuteStep: 30,
      disableFocus: true,
      template: 'dropdown',
      showMeridian: false,
    });

    $(document).on("click", "#deleteButton", function() {


      let trElement = $(this).parent().parent();
      let teacherId = $(this).attr('data-teacher-id')
      let full_name = $(this).attr('data-teacher-full_name')

      var YOUR_MESSAGE_STRING_CONST = `Do You want to Delete Teacher <b>${full_name}</b>`;

      confirmDialog(YOUR_MESSAGE_STRING_CONST, function() {
        $.post("{{route('destroyTeacher')}}", {
          _token: "{{csrf_token()}}",
          teacher_id: teacherId
        }, function(response) {


          if (response.status) {
            table.row(trElement).remove().draw();
          } else {
            console.log(response.errors);
          }
        })

      });


      function confirmDialog(message, onConfirm) {
        var fClose = function() {
          modal.modal("hide");
        };
        var modal = $("#confirmModal");
        modal.modal("show");
        $("#confirmMessage").empty().append(message);
        $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
        $("#confirmCancel").unbind().one("click", fClose);
      }


    });
    $(document).on("click", "#editButton", function() {


      updateTrElement = $(this).parent().parent();

      let teacherId = $(this).attr('data-teacher-id')


      $.post("{{route('editTeacher')}}", {
        '_token': "{{csrf_token()}}",
        'teacher_id': teacherId
      }, function(response) {
        if (response.status) {
          $('#formContainer').html(response.view)
          $('#formContainer')[0].scrollIntoView();
        } else {
          console.log("error");
        }



      });
    });
    $(document).on('click', '#update', function() {

      emptyErrorSpan()
      let allData = {};
      $.each($('form').serializeArray(), function(i, field) {
        allData[field.name] = field.value;
      });

      $.post("{{route('updateTeacher')}}", {
        '_token': "{{csrf_token()}}",
        'data': allData
      }, function(response) {

        if (response.status) {

          let tr = []
          let teacherId;


          $.each(allData, function(index, value) {


            if (index == 'teacher_old_id') {
              return
            }
            tr.push(value);

          });
          tr.push(`<i id='editButton' data-teacher-id="${allData.teacher_id}" class='purple-icon fas fa-fw fa-edit'></i>`);
          tr.push(`<i id='deleteButton' data-teacher-id="${allData.teacher_id}" class='purple-icon fas fa-fw fa-trash'></i>`);
          let url = `{{route('editTeacherPassword',['id'=>128])}}`;
          url = url.replace('128', allData.teacher_id);
          tr.push(`<a href="${url}" class='btn btn-primary'>Edit</a>`);


          table.row(updateTrElement).data(tr).draw();
          $('#formContainer').html(response.view)
          $('table')[0].scrollIntoView();
          resetForm()

        } else {
          fillErrorSpan(response.errors)
        }
      });
    })

    function resetForm() {
      $(':input', 'form')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
    }

    function emptyErrorSpan() {
      for (const span of $('.invalid-feedback')) {

        span.innerHTML = '';

        span.parentElement.querySelector('input').classList.remove("is-invalid");



      }
    }

    function fillErrorSpan(errors) {
      $.each(errors, function(key, value) {
        let span = $("#" + key + "_error");
        let input = span.parent().find("input").addClass('is-invalid')
        span.html(value[0])
      });
    }
  })
</script>