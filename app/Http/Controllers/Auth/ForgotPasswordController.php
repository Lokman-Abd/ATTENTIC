<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
  /**
   * Write code on Method
   *
   * @return response()
   */
  public function showForgetPasswordForm()
  {
    return view('auth.forgetPassword');
  }
  function validateForgetPasswordRequest($request)
  {
    $rolesString = implode(',', array_keys(config('auth.guards')));
    $tableName = $request->userType . 's';
    return Validator::make($request->all(), [
      'email' => 'required|email|exists:' . $tableName . ',email',
      'userType' => ['required', 'in:' . $rolesString],
    ]);
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function submitForgetPasswordForm(Request $request)
  {
    $validator = $this->validateForgetPasswordRequest($request);

    if ($validator->fails()) {
      return redirect()->back()->withError($validator)->withInput();
    }
    $this->sendResetPasswordMail($request);

    return back()->with('message', 'We have e-mailed your password reset link!');
  }
  function sendResetPasswordMail($request)
  {
    $token = Str::random(64);
    PasswordReset::create([
      'email' => $request->email,
      'token' => $token,
      'user_type' => $request->userType
    ]);
    // TODO make this email as queue
    // try catch the error if happend
    Mail::to($request->email)->send(new ResetPasswordMail($token, $request->userType));
  }
  /**
   * Write code on Method
   *
   * @return response()
   */
  public function showResetPasswordForm($token, $userType)
  { 
    
    $rolesString = implode(',', array_keys(config('auth.guards')));
    $data=['token'=>$token,'userType'=>$userType];
    $validator = Validator::make($data, [
    'userType' => ['required', 'in:' . $rolesString],
    'token' => ['required','exists:password_resets,token']
  ]);

  if ($validator->fails()) {
    return redirect()->route('login')->withError(['msg' => 'Invalid token!']);
  }
    return view('auth.forgetPasswordLink', ['token' => $token, 'userType' => $userType]);
  }

  function validateResetPasswordFrom(Request $request,$tableName) {
    $rolesString = implode(',', array_keys(config('auth.guards')));

    
    $validator = Validator::make($request->all(), [
      'userType' => ['required', 'in:' . $rolesString],
      'email' => 'required|email|exists:' . $tableName . ',email',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required',
      'token' => ['required','exists:password_resets,token'],
    ]);
    return $validator;
  }
  public function submitResetPasswordForm(Request $request)
  {
    $tableName = $request->userType . 's';

    $validator=$this->validateForgetPasswordRequest($request,$tableName);
    
    if ($validator->fails()) {
      return redirect()->back()->withError($validator)->withInput();
    }

    $updatePassword = PasswordReset::where([
      'email' => $request->email,
      'token' => $request->token,
      'userType' => $request->userType
    ])->first();

    if (!$updatePassword) {
      return back()->withError(['msg' => 'Invalid token!'])->withInput();
    }

    DB::table($tableName)
      ->where(['email' => $request->email])
      ->update([
        "password" => $request->password
      ]);
    $updatePassword->delete();

    return redirect()->route('login')->withSuccess('Your password has been changed!');
  }
}
