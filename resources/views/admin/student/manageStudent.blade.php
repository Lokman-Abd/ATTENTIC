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
    <h1 class="h3 mb-0 text-gray-800">Manage Students</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Manage Students</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        @include('admin.student.create_form')
      </div>
      <!-- Input Group -->
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
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Group</th>
                    <th data-sortable='false'>Edit</th>
                    <th data-sortable='false'>Delete</th>
                    <th data-sortable='false'>Update Password</th>
                  </tr>
                </thead>

                <tbody>
                  <!-- DB -->
                  <!-- sample -->
                  @foreach ($students as $student)
                  <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->group->name}}</td>
                    <td><a href="{{route('students.edit',$student)}}"><i class='purple-icon fas fa-fw fa-edit'></i></a></td>
                    <td>
                        <form method="post" action="{{route('students.destroy',$student)}}">
                        @method("DELETE")
                        @csrf
                        <button style="all:unset" type="submit"><i class='purple-icon fas fa-fw fa-trash'></i>
                        </form>
                    </td>
                    <td><a href="{{route('student.editPassword',$student)}}" class='btn btn-primary'>Edit</a></td>
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

    var table = $('#dataTableHover').DataTable(({
      columnDefs: [{
        "defaultContent": "-",
        "targets": "_all"
      }],
    })); // ID From dataTable with Hover



  })
</script>
</body>

</html>