<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Mail\ContactUs;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

class AuthTestController extends Controller
{

    // public function getUsernameAndCount(){
    //     $this->count = Justification::where('justification_status','=','0')->count();
    //     $this->username= Auth::guard('admin')->user()->admin_first_name . ' '.Auth::guard('admin')->user()->admin_last_name;
    // }


    public function getGuard()
    {
        if (Auth::guard('admin')->check()) {
            return 'admin';
        }
        if (Auth::guard('teacher')->check()) {
            return 'teacher';
        }
        if (Auth::guard('student')->check()) {
            return 'student';
        }
        return null;
    }
    public function login()
    {
        $guard = $this->getGuard();
        if ($guard === 'admin') {

            return redirect()->route('dashboard');
        }
        if ($guard === 'teacher') {
            return redirect()->route('teacherDashboard');
        }
        if ($guard === 'student') {
            return redirect()->route('student_dashboard');
        }
        return view('login-index');
    }
    public function checkLoginGuard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userType' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withError($validator);
        }

        $userGurad = $request->userType;

        $route = [
            'admin' => 'dashboard',
            'teacher' => 'teacherDashboard',
            'student' => 'student_dashboard'
        ];

        if (in_array($userGurad, ['admin', 'teacher', 'student'])) {

            if (Auth::guard($userGurad)->attempt([$userGurad . '_email' => $request->email, 'password' => $request->password])) {

                return redirect()->intended(route($route[$userGurad]));
                // return redirect()->route($route[$userGurad]);
            }
        }

        return redirect()->back()->withError('Oppes! You have entered invalid credentials')->withInput();
    }

    public function logout()
    {
        $guards = array_keys(config('auth.guards'));
        foreach ($guards as $guard) {
            if (auth()->guard($guard)->check()) {
                auth($guard)->logout();
            }
            Session::flush();
            return redirect()->route('login');
        }
    }
    public function updatePassword(Request $request)
    {
        $guard = $this->getGuard();
        $username = '';
        $count = '';

        if ($guard === 'admin') {

            $admin = new TeacherController;
            $admin->getUsernameAndCount();
            $username = $admin->username;
            $count = $admin->count;
        } elseif ($guard === 'teacher') {
            $teacher = new StudyController;
            $teacher->getUsername();
            $username = $teacher->username;
        } elseif ($guard === 'student') {
            $student = new justification_controller;
            $student->getUsername();
            $username = $student->username;
        } else {
            return redirect()->route('login');
        }
        $data = [
            'guard' => $guard,
            'username' => $username,
            'count' => $count,
            'student_id' => ''
        ];
        return view('update_password')->with($data);
    }
    public function postUpdatePassword(Request $request)
    {

        // guard must be admin or student or teacher
        // talbe are admins or students or teachers
        $users = [
            'admin' => new Admin,
            'teacher' => new Teacher,
            'student' => new Student,
        ];
        $guard = $this->getGuard();
        $guard_id = $request->get($guard . '_id');
        $currentUser = $users[$guard]->find($guard_id);

        $currentUserPassword = $currentUser->toArray()[$guard . '_password'];


        $validator = Validator::make($request->all(), [
            $guard . '_current_password' => ['required', function ($attribute, $value, $fail) use ($currentUserPassword) {
                if (!Hash::check($value, $currentUserPassword)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            $guard . '_new_password' => ['required', 'confirmed', 'min:6'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $currentUser->update([
            $guard . '_password' => Hash::make($request->get($guard . '_new_password'))
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
