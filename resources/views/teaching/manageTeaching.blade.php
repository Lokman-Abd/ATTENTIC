<!--non-changing part-->
@include("admin.Includes.topLayout")

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  @if (session('success'))
  <div class="alert alert-success text-center" role="alert">
    {{ session('success') }}
  </div>
  @endif
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Module And Types Teaching</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Module And Types Teaching</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        <!-- Form Basic -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Create Teaching</h6>
          create new teaching
        </div>
        <div class="card-body">
          <form>
            <div class="form-group row mb-3">
              <div class="col-xl-6">

                <label>Select Teacher</label>
                <select id="select_teacher" name="teacher_id" class="form-control ">
                  <option value="null" selected> Choose Teacher</option>
                  @foreach ($teachers as $teacher)
                  <option value="{{$teacher['teacher_id']}}">{{$teacher['teacher_last_name']}} {{$teacher['teacher_first_name']}}</option>
                  @endforeach
                </select>
                <span id="teacher_id_error" class="invalid-feedback"></span>

              </div>
              <div class="col-xl-6">
                <label>Select Module</label>
                <select id="select_module" name="module_id" class="form-control ">
                  <option value="null" selected> Choose Module</option>
                  @foreach ($modules as $module)
                  <option value="{{$module['module_id']}}">{{$module['short_cut']}}</option>
                  @endforeach
                </select>
                <span id="module_id_error" class="invalid-feedback"></span>
              </div>
            </div>
            <div class="form-group row mb-3">
             

              <div class="col-xl-6">
                <label>Select Section</label>
                <select id='select_section' multiple name="types" class="form-control">

                </select>
                <span id="types_error" class="invalid-feedback"></span>

              </div>

            </div>
            <div class="form-group row mb-3">
              <div class="col-xl-6">
                <button type="button" id='submit' name="save" value="save" class="btn btn-primary">Save</button>
              </div>
            </div>

          </form>
        </div>
      </div>
      <!-- Input Group -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">All Class Teachers</h6>
            </div>
            <div class="table-responsive p-3">
              <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                  <tr>
                    <th></th>
                    <th>Teacher</th>
                    <th>Module</th>
                    <th>Type</th>
                    <th>Delete</th>

                  </tr>
                </thead>

                <tbody>
                  <!-- DB -->
                  <!-- sample -->
                  @foreach ($typings as $typing)
                  @foreach ($typing->teachedBy as $teacher)
                  <tr>
                    <td></td>
                    <td>{{$teacher['teacher_first_name']}} {{$teacher['teacher_last_name']}}</td>
                    <td>{{$typing->module->short_cut}}</td>
                    <td>{{$typing->type->type}}</td>
                    <td><i id='deleteButton' data-teacher-id="{{$teacher['teacher_id']}}" data-typing-id="{{$typing['typing_id']}}" data-module-name='{{$typing->module->short_cut}}' data-teacher-full-name="{{$teacher['teacher_last_name']}}  {{$teacher['teacher_first_name']}} " data-type-name='{{$typing->type->type}}' data-toggle="modal" data-target="#exampleModal" class='purple-icon fas fa-fw fa-trash'></i></td>
                  </tr>
                  @endforeach
                  @endforeach
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
@include("admin.Includes.bottomLayout")

<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {

    let updateTrElement;
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



    $('#select_module').on('change', function() {
      $.post("{{route('getTypes')}}", {
        '_token': "{{csrf_token()}}",
        'id': this.value
      }, function(response) {

        if (response.status) {
          $('#select_section').html('');
          response.types.forEach(type => {
            $('#select_section').append($('<option>', {
              value: type.type_id,
              text: type.type,
            }));
          });

        } else {
          displayErrorMessage(response.message)
        }
      });
    });





    $("#submit").on("click", function() {
      emptyErrorSpan()

      let allData = {

      };


      let types = $('select[name=types]').val();
      let module_id = $('select[name=module_id]').val();
      let teacher_id = $('select[name=teacher_id]').val();
      allData['types'] = types;
      allData['module_id'] = module_id;
      allData['teacher_id'] = teacher_id;


      $.post("{{route('storeTeaching')}}", {
        '_token': "{{csrf_token()}}",
        'data': allData
      }, function(response) {


        if (response.status) {


          let rows = [];
          let tr;

          $.each(response.data, function(key, value) {



            tr = []
            tr.push(table.rows().count() + 1)
            tr.push(response.teacher_full_name)
            tr.push(response.short_cut)
            tr.push(value.type);
            tr.push(`<i id='deleteButton' data-teacher-id="${teacher_id}" data-typing-id="${key}" data-module-name='${response.short_cut}' data-teacher-full-name="${response.teacher_full_name} "  data-type-name='${value.type}' data-toggle="modal" data-target="#exampleModal" class='purple-icon fas fa-fw fa-trash'></i>`);
            rows.push(tr);

          });

          table.rows.add(rows).draw();


        } else {
          displayErrorMessage(response.message)
          fillErrorSpan(response.errors);

        }
      });
    });
    $(document).on("click", "#deleteButton", function() {


      let trElement = $(this).parent().parent();
      let teacherId = $(this).attr('data-teacher-id')
      let typingId = $(this).attr('data-typing-id')
      let moduleName = $(this).attr('data-module-name')
      let typeName = $(this).attr('data-type-name')
      let teacher_full_name = $(this).attr('data-teacher-full-name')

      var YOUR_MESSAGE_STRING_CONST = `Do You want to Delete <b>${teacher_full_name}</b> for <b>${moduleName}</b> <b>${typeName}</b>`;

      confirmDialog(YOUR_MESSAGE_STRING_CONST, function() {

        $.post("{{route('destroyTeaching')}}", {
          _token: "{{csrf_token()}}",
          teacher_id: teacherId,
          typing_id: typingId,
        }, function(response) {

          if (response.status) {
            table
              .row(trElement)
              .remove()
              .draw();
          } else {
            displayErrorMessage(response.message)

            // console.log(response.errors);
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


    function emptyErrorSpan() {
      
      for (const span of $('.invalid-feedback')) {

        span.innerHTML = '';
        span.parentElement.querySelector('select').classList.remove("is-invalid");
      }
      $('.alert.alert-danger').remove()
    }

    function fillErrorSpan(errors) {
      $.each(errors, function(key, value) {
        let span = $("#" + key + "_error");
        let input = span.parent().find("select").addClass('is-invalid')
        span.html(value[0])
      });
    }

    function displayErrorMessage(message) {
      if ($('.alert.alert-danger').length) {
        $('.alert.alert-danger').html(message)
      } else {
        $('#container-wrapper').prepend(
          `
          <div class="alert alert-danger" role="alert">
          ${message}
          </div>
          `
        )
      }
    }
  })
</script>
</body>

</html>