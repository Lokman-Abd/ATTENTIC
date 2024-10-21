<!-- Form Basic -->
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
  <h6 class="m-0 font-weight-bold text-primary">Create Teachers</h6>
  create new teacher
</div>
<div class="card-body">
<form method="post" action="{{route('teachers.store')}}">
@csrf
    <div class="form-group row mb-3">

      <div class="col-xl-6">
        <label class="form-control-label">ID<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control @error('id') is-invalid @enderror" value="{{old('id')}}" required name="id" >
        <span id="id_error" class="invalid-feedback">{{ $errors->first('id') }}</span>
      </div>
     
      <div class="col-xl-6">
        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" required name="first_name" >
        <span id="first_name_error" class="invalid-feedback">{{ $errors->first('first_name') }}</span>
       
      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name')}}" required name="last_name" >
        <span id="last_name_error" class="invalid-feedback">{{ $errors->first('last_name') }}</span>

      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Grade<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('grade') is-invalid @enderror" value="{{old('grade')}}" required name="grade" >
        <span id="grade_error" class="invalid-feedback">{{ $errors->first('grade') }}</span>

      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required name="email" >
        <span id="email_error" class="invalid-feedback">{{ $errors->first('email') }}</span>

      </div>
      <div class="col-xl-6">
        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" required name="password" >
        <span id="password_error" class="invalid-feedback">{{ $errors->first('password') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Phone No<span class="text-danger ml-2">*</span></label>
        <input type="number" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" name="phone" >
        <span id="phone_error" class="invalid-feedback">{{ $errors->first('phone') }}</span>
      
      </div>
    </div>
    <div class="form-group row mb-3">
      <div class="col-xl-6">
       
        <button type="submit" id='submit' name="save" value="save" class="btn btn-primary">Save</button>
      </div>
    </div>

  </form>
</div>