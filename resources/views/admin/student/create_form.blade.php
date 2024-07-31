<!-- Form Basic -->
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">Create Students</h6>
  create new student
</div>
<div class="card-body">
  <form method="post" action="{{route('students.store')}}">
    @csrf
    <div class="form-group row mb-3">
      <div class="col-xl-6">
        <label class="form-control-label">Student Card Number<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control @error('student_card') is-invalid @enderror" name="student_card" value="{{ old('student_card') }}">
        <span id="student_card_error" class="invalid-feedback">{{ $errors->first('student_card') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('student_first_name') is-invalid @enderror" required name="student_first_name" value="{{ old('student_first_name') }}">
        <span id="student_first_name_error" class="invalid-feedback">{{ $errors->first('student_first_name') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('student_last_name') is-invalid @enderror" required name="student_last_name" value="{{ old('student_last_name') }}">
        <span id="student_last_name_error" class="invalid-feedback">{{ $errors->first('student_last_name') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control @error('student_email') is-invalid @enderror" required name="student_email" value="{{ old('student_email') }}">
        <span id="student_email_error" class="invalid-feedback">{{ $errors->first('student_email') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control @error('student_password') is-invalid @enderror" required name="student_password" value="{{ old('student_password') }}">
        <span id="student_password_error" class="invalid-feedback">{{ $errors->first('student_password') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Select Group<span class="text-danger ml-2">*</span></label>
        <select required name="group_id" class="form-control mb-3 @error('group_id') is-invalid @enderror">
          <option>--Select Group--</option>
          @foreach($groups as $group)
          <option value='{{$group->group_id}}'>{{$group->group_name}}</option>
          @endforeach
        </select>
        <span class="text-danger" id="group_id_error">{{ $errors->first('group_id') }}</span>
      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">

        <button id='submit' name="save" value="save" class="btn btn-primary">Save</button>
      </div>
    </div>

  </form>
</div>