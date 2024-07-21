<!DOCTYPE html>
<html>
@include("admin.includes.head")

<!-- Login Content -->
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">

                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif

                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf


                            <div class="form-group row mb-3">




                                <div class="col-xl-6">
                                    <label class="form-control-label">Select Role<span class="text-danger ml-2">*</span></label>
                                    <select name="userType" class="form-control mb-3">
                                        <option value="">--Select User Roles--</option>
                                        <option {{ (old("userType") == 'admin' ? "selected":"") }} value="admin">Admin</option>
                                        <option {{ (old("userType") == 'teacher' ? "selected":"") }} value="teacher">Teacher</option>
                                        <option {{ (old("userType") == 'student' ? "selected":"") }} value="student">Student</option>
                                    </select>
                                    @if ($errors->has('userType'))
                                    <span class="text-danger">{{ $errors->first('userType') }}</span>
                                    @endif
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <label for="email_address" class="form-control-label">E-Mail Address <span class="text-danger ml-2">*</span></label>

                                    <input type="text" id="email_address" class="form-control" name="email" value="{{old('email')}}" autofocus>
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                              
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include("admin.Includes.ScriptsCall")
</body>

</html>