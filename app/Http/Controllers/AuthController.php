<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Mail\ContactUs;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Justification;
use App\Http\Requests\AuthForm;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

class AuthController extends Controller
{
    // TODO remove this function after checking its role
    // public function getUsernameAndCount(){
    //     $this->count = Justification::where('justification_status','=','0')->count();
    //     $this->username= Auth::guard('admin')->user()->admin_first_name . ' '.Auth::guard('admin')->user()->admin_last_name;
    // }

    protected $routes = [
        'admin' => 'dashboard',
        'teacher' => 'teacherDashboard',
        'student' => 'student_dashboard'
    ];

    public function getGuard()
    {
        foreach(array_keys(config('auth.guards')) as $guard){

            if(auth()->guard($guard)->check()) return $guard;
        }
        return null;
    }
    public function login()
    {
        $guard = $this->getGuard();
        if (!$guard) {
            return view('login-index');
        }
        return redirect()->route($this->routes[$guard]);
    }
    public function checkLoginGuard(AuthForm $request)
    {   
        $userGurad = $request->userType;

        if (in_array($userGurad, array_keys(config('auth.guards'))) &&
        auth($userGurad)->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended(route($this->routes[$userGurad]));
        }

        return redirect()->back()->withError('Oppes! You have entered invalid credentials')->withInput();
    }

    public function logout()
    {
        $currentGurd=$this->getGuard();
        auth($currentGurd)->logout();
        Session::flush();
        return redirect()->route('login');
    }
    public function updatePassword()
    {
        $guard = $this->getGuard();
        if (!$guard) return redirect()->route('login');
        $data = [
            'guard' => $guard,
            // 'student_id' => ''
        ];
        return view('update_password')->with($data);
    }
    public function postUpdatePassword(Request $request)
    {
        // guard must be admin or student or teacher
        // talbe are admins or students or teachers
        $currentUser = auth()->user();
        $currentUserPassword = $currentUser->password;

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($currentUserPassword) {
                if (!Hash::check($value, $currentUserPassword)) {
                    return $fail('The current password is incorrect.');
                }
            }],
            'new_password' => ['required', 'confirmed', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $currentUser->update([
            'password' => $request->new_password
        ]);

        return redirect()->back()->withSuccess('Password changed successfully');
    }
    public function contactUs(Request $request)
    {

        try {
            $validator = Validator::make($request->data, [
                'name' => 'required',
                'email_address' => 'required|email',
                'email_content' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
            }
            $devolopers = [
                'omar.goumgoum@univ-constantine2.dz',
                'kaouther.baktache@univ-constantine2.dz',
                'redouane.daddiouamer@univ-constantine2.dz',
                'lokmane.abdessalam@univ-constantine2.dz',
                'abdelhadi.lakaf@univ-constantine2.dz',
                'rami.bounaas@univ-constantine2.dz',
                'rania.benarab@univ-constantine2.dz',
                'yousra.affes@univ-constantine2.dz',
                'amira.ziadi@univ-constantine2.dz',
            ];

            foreach ($devolopers as $devolver) {
                Mail::to($devolver)->send(new ContactUs($request->data['name'], $request->data['email_address'], $request->data['email_content']));
            }
            return response()->json(['status' => true, 'message' =>'Email Sent Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' =>'Sorry Something went wrong']);
        }
    }
}
