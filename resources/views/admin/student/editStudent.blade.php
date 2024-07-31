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
    <h1 class="h3 mb-0 text-gray-800">Edit Students</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Students</li>
    </ol>
  </div>
  <!-- Container Form -->
  <div class="row">
    <div class="col-lg-12">

      <div id="formContainer" class="card mb-4">
        <!-- Form Basic -->

        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Upadte A Student</h6>
          update {{$student['student_first_name']}} {{$student['student_last_name']}}
        </div>
        <div class="card-body">
          <form method="post" action="{{route('students.update',$student)}}">
            @method("PATCH")
            @csrf
            <div class="form-group row mb-3">
              <input type="hidden" name="student_id" value="{{$student->student_id }}">
              <div class="col-xl-6">
                <label class="form-control-label">Student Card Number<span class="text-danger ml-2">*</span></label>
                <input type="number" class="form-control @error('student_card') is-invalid @enderror" name="student_card" value="{{ old('student_card', $student->student_card )}}">
                <span id="student_card_error" class="invalid-feedback">{{ $errors->first('student_card') }}</span>
              </div>

              <div class="col-xl-6">
                <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
                <input type="text" class="form-control @error('student_first_name') is-invalid @enderror" required name="student_first_name" value="{{ old('student_first_name', $student->student_first_name )}}">
                <span id="student_first_name_error" class="invalid-feedback">{{ $errors->first('student_first_name') }}</span>
              </div>

              <div class="col-xl-6">
                <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
                <input type="text" class="form-control @error('student_last_name') is-invalid @enderror" required name="student_last_name" value="{{ old('student_last_name',$student->student_last_name )}}">
                <span id="student_last_name_error" class="invalid-feedback">{{ $errors->first('student_last_name') }}</span>
              </div>

              <div class="col-xl-6">
                <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
                <input type="email" class="form-control @error('student_email') is-invalid @enderror" required name="student_email" value="{{ old('student_email',$student->student_email )}}">
                <span id="student_email_error" class="invalid-feedback">{{ $errors->first('student_email') }}</span>
              </div>

              <div class="col-xl-6">
                <label class="form-control-label">Select Group<span class="text-danger ml-2">*</span></label>
                <select required name="group_id" class="form-control mb-3 @error('group_id') is-invalid @enderror">
                  <option>--Select Group--</option>
                  @foreach($groups as $group)
                  <option @if($student->group_id==$group->group_id) selected @endif value='{{$group->group_id}}'>{{$group->group_name}}</option>
                  @endforeach
                </select>
                <span class="text-danger" id="group_id_error">{{ $errors->first('group_id') }}</span>
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-xl-6">
                <button id="update" type="submit" class="btn btn-warning">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Input Group -->

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