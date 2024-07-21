<!-- Form Basic -->

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">Upadte A Student</h6>
   update {{$student['student_first_name']}}  {{$student['student_last_name']}}
</div>
<div class="card-body">
  <form>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
        <label class="form-control-label">ID<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control" required name="student_id" value="{{$student['student_id']}}">
        <span id="student_id_error" class="invalid-feedback"></span>
      </div>
        <input type="hidden" class="form-control" required name="student_old_id" value="{{$student['student_id']}}">
      <div class="col-xl-6">
        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control" required name="student_first_name" value="{{$student['student_first_name']}}">
        <span id="student_first_name_error" class="invalid-feedback"></span>
      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control" required name="student_last_name" value="{{$student['student_last_name']}}">
        <span id="student_last_name_error" class="invalid-feedback"></span>
      </div>
     
      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control" required name="student_email" value="{{$student['student_email']}}">
        <span id="student_email_error" class="invalid-feedback"></span>
      </div>
     
      <div class="col-xl-6">
        <label class="form-control-label">Select Group<span class="text-danger ml-2">*</span></label>
        <select required name="group_id" class="form-control mb-3">
          <option>--Select Group--</option>
          <option @if($student['group_id']=='1') {{'selected'}} @endif value="1">G1</option>
          <option @if($student['group_id']=='2') {{'selected'}} @endif value="2">G2</option>
          <option  @if($student['group_id']=='3') {{'selected'}} @endif value="3">G3</option>
        </select>
        <span class="text-danger" id="group_id_error"></span>

      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
        <button id="update" type="button" class="btn btn-warning" >Update</button>
      </div>
    </div>
  </form>
</div>