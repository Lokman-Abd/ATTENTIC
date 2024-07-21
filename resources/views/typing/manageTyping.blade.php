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
    <h1 class="h3 mb-0 text-gray-800">Manage Types</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Types</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        @include('typing.Includes.create_module_form')
      </div>
      <!-- Input Group -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">All Types In Modules</h6>
            </div>
            <div class="table-responsive p-3">
              <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead class="thead-light">
                  <tr>
                    <th></th>
                    <th>Module</th>
                    @foreach ($types as $type)
                    <th>{{$type->type}}</th>
                    @endforeach
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>

                <tbody>
                  <!-- DB -->
                  <!-- sample -->
                  @foreach ($modules as $module)

                  <tr>
                    <td></td>
                    <td>{{$module['short_cut']}}</td>
                    @foreach ($types as $type)
                    @if($type->hasThisModule($module->module_id))
                    <td><i class="purple-icon fas fa-fw fa-check"></i></td>
                    @else
                    <td><i class="red-icon fas fa-times"></i></td>
                    @endif
                    @endforeach
                    <td><i id='editButton' data-module-id="{{$module['module_id']}}" class='purple-icon fas fa-fw fa-edit'></i></td>
                    <td><i id='deleteButton' data-module-id="{{$module['module_id']}}" data-module-name="{{$module['short_cut']}}" data-toggle="modal" data-target="#exampleModal" class='purple-icon fas fa-fw fa-trash'></i></td>
                  </tr>
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


    $(document).on("click", '#submit', function() {
      emptyErrorSpan()
      let allData = {

      };
      $.each($('form').serializeArray(), function(i, field) {
        allData[field.name] = field.value;
      });


      let types = $('select[name=types]').val();
      allData['types'] = types;



      $.post("{{route('storeTyping')}}", {
        '_token': "{{csrf_token()}}",
        'data': allData
      }, function(response) {

        if (response.status) {
          let tr = []
          tr.push(table.rows().count() + 1)
          tr.push(response.short_cut)
          for (let index = 1; index <= 3; index++) {
            if (response.data[index] == null) {
              tr.push(`<td><i class="red-icon fas fa-times"></i></td>`)
            } else {
              tr.push(` <td><i class="purple-icon fas fa-fw fa-check"></i></td>`)
            }
          }
          tr.push(`<i id='editButton' data-module-id="${response.module_id}" class='purple-icon fas fa-fw fa-edit'></i>`);
          tr.push(`<i id='deleteButton' data-module-id="${response.module_id}" data-module-name="${response.short_cut}"   data-toggle="modal" data-target="#exampleModal" class='purple-icon fas fa-fw fa-trash'></i>`);

          table.row.add(tr).draw();
          resetForm()

        } else {
          fillErrorSpan(response.errors);
          displayErrorMessage(response.message)
        }
      });
    });
    $(document).on("click", "#deleteButton", function() {


      let trElement = $(this).parent().parent();
      let moduleId = $(this).attr('data-module-id')
      let options
      // let typeId = $(this).attr('data-type-id')
      let moduleName = $(this).attr('data-module-name')
      // let typeName = $(this).attr('data-type-name')


      $.post("{{route('getTypes')}}", {
        '_token': "{{csrf_token()}}",
        'id': moduleId
      }, function(response) {

        if (response.status) {
          TypesObject = response.types

          var YOUR_MESSAGE_STRING_CONST = `What Do You want to Delete for Module <b>${moduleName}</b>`
          TypesObject.forEach(type => {
            options += ` <option value="${type.type_id}">${type.type}</option>`
          });
          var DEATAILS = `
      <div  class="col">
        <label>Select Section</label>
            <select multiple name="typesToDelete" class="form-control" >
            ${options}
            </select>
            <span id="types_error" class="invalid-feedback"></span>
        </div>
      
      `;

          confirmDialog(YOUR_MESSAGE_STRING_CONST, function() {

            let typesToDelete = $('select[name=typesToDelete]').val();
            $.post("{{route('destroyTyping')}}", {
              _token: "{{csrf_token()}}",
              data: {
                module_id: moduleId,
                types: typesToDelete
              }
            }, function(response) {

              if (response.status) {
                if (!response.allTypes) {

                  let tr = []
                  value = table.rows().count() + 1
                  tr.push(value);
                  tr.push(moduleName)
                  for (let index = 1; index <= 3; index++) {

                    if (response.types.includes(index)) {
                      tr.push(` <td><i class="purple-icon fas fa-fw fa-check"></i></td>`)
                    } else {
                      tr.push(`<td><i class="red-icon fas fa-times"></i></td>`)
                    }
                  }
                  tr.push(`<i id='editButton' data-module-id="${moduleId}" class='purple-icon fas fa-fw fa-edit'></i>`);
                  tr.push(`<i id='deleteButton' data-module-id="${moduleId}"  data-module-name="${moduleName}"  class='purple-icon fas fa-fw fa-trash'></i>`)

                  table.row(trElement).data(tr).draw();




                } else {
                  table
                    .row(trElement)
                    .remove()
                    .draw();
                }
              } else {
                displayErrorMessage(response.message)
                // console.log(response.errors);
              }
            })

          }, DEATAILS);

        } else {
          displayErrorMessage(response.message)
        }
      });






      function confirmDialog(message, onConfirm, deatails) {
        var fClose = function() {
          modal.modal("hide");
        };
        var modal = $("#confirmModal");
        modal.modal("show");
        $("#confirmMessage").empty().append(message);
        $("#deatails").empty().append(deatails);
        $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
        $("#confirmCancel").unbind().one("click", fClose);
      }


    });
    $(document).on("click", "#editButton", function() {
      updateTrElement = $(this).parent().parent();

      let ModuleId = $(this).attr('data-Module-id')

      $.post("{{route('editTyping')}}", {
        '_token': "{{csrf_token()}}",
        'id': ModuleId
      }, function(response) {

        if (response.status) {


          $('#formContainer').html(response.view)
          $('#formContainer')[0].scrollIntoView();
        } else {
          displayErrorMessage(response.message)
        }
      });
    });
    $(document).on('click', '#update', function() {

      emptyErrorSpan()
      let allData = {};
      $.each($('form').serializeArray(), function(i, field) {
        allData[field.name] = field.value;
      });


      let types = $('select[name=types]').val();
      allData['types'] = types;


      $.post("{{route('updateTyping')}}", {
        '_token': "{{csrf_token()}}",
        'data': allData
      }, function(response) {

        if (response.status) {         

          let tr = []
          value = table.rows().count() + 1
          tr.push(value);
          tr.push(response.short_cut)
          for (let index = 1; index <= 3; index++) {

            if (response.types.includes(index)) {
              tr.push(` <td><i class="purple-icon fas fa-fw fa-check"></i></td>`)
            } else {
              tr.push(`<td><i class="red-icon fas fa-times"></i></td>`)
            }
          }
          tr.push(`<i id='editButton' data-module-id="${allData.module_id}" class='purple-icon fas fa-fw fa-edit'></i>`);
          tr.push(`<i id='deleteButton' data-module-id="${allData.module_id}"  data-module-name="${allData.short_cut}"  class='purple-icon fas fa-fw fa-trash'></i>`);
          table.row(updateTrElement).data(tr).draw();

          $('#formContainer').html(response.view)

          $('table')[0].scrollIntoView();
          resetForm()

        } else {
          displayErrorMessage(response.message)
          fillErrorSpan(response.errors)
        }
      });
    })


    function emptyErrorSpan() {
    
      for (const span of $('.invalid-feedback')) {

        span.innerHTML = '';
        selectElement=span.parentElement.querySelector('select')
        if(selectElement!==null) {
          selectElement.classList.remove("is-invalid");
        }
      }
    }

    function resetForm() {
      $(':input', 'form')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
    }


    function fillErrorSpan(errors) {
      $.each(errors, function(key, value) {
        let span = $("#" + key + "_error");
        let input = span.parent().find("select ,input").addClass('is-invalid')
        span.html(value[0])
      });
      $('.alert.alert-danger').remove()
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