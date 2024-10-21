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
        <input type="number" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{ old('card_number') }}">
        <span id="card_number_error" class="invalid-feedback">{{ $errors->first('card_number') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" required name="first_name" value="{{ old('first_name') }}">
        <span id="first_name_error" class="invalid-feedback">{{ $errors->first('first_name') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
        <input type="text" class="form-control @error('last_name') is-invalid @enderror" required name="last_name" value="{{ old('last_name') }}">
        <span id="last_name_error" class="invalid-feedback">{{ $errors->first('last_name') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Email Address<span class="text-danger ml-2">*</span></label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" required name="email" value="{{ old('email') }}">
        <span id="email_error" class="invalid-feedback">{{ $errors->first('email') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" required name="password" value="{{ old('password') }}">
        <span id="password_error" class="invalid-feedback">{{ $errors->first('password') }}</span>
      </div>

      <div class="col-xl-6">
        <label class="form-control-label">Select Group<span class="text-danger ml-2">*</span></label>
        <select required name="group_id" class="form-control mb-3 @error('group_id') is-invalid @enderror">
          <option>--Select Group--</option>
          @foreach($groups as $group)
          <option value='{{$group->id}}'>{{$group->name}}</option>
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