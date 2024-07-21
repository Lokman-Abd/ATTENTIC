<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Absence;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Gr_Teaching;
use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public $username;
    public $count;


    public function getUsernameAndCount(){
        $this->count = Justification::where('justification_status','=','0')->count();
        $this->username= Auth::guard('admin')->user()->admin_first_name . ' '.Auth::guard('admin')->user()->admin_last_name;
    }


    public function dashboard()
    {
        $this->getUsernameAndCount();
        $students_number= Student::getAllStudentsNumber();
        $teachers_number= Teacher::getAllTeachersNumber();
        $classes_number= Gr_Teaching::getAllGroupTeaching();
        $modules_number= Module::getAllModulesNumber();
        $absent_students= Absence::getAbsentStudentsNumberToday();
        $month= Absence::getAbsentPercentage();
       

        $data = [
            'username' => $this->username,
            'students_number'=>$students_number,
            'classes_number'=>$classes_number,
            'absent_students'=>$absent_students,
            'teachers_number'=>$teachers_number,
            'modules_number'=>$modules_number,
            'month'=>$month,
            'count'=>$this->count,
            
        ];
        return view('admin.dashboard')->with($data);

    }

    public function manage()
    {
        $this->getUsernameAndCount();

        $teachers = Teacher::all();
        $data = [
            'username' => $this->username,
            'count' => $this->count,
            'teachers'   => $teachers,
        ];

        
        return view('admin.teacher.manageTeacher')->with($data);
    }


    public function store(Request $request)
    {
        $validator=Validator::make($request->data,[
            'teacher_id' =>['required','unique:teachers','numeric'],
            'teacher_first_name' =>'required',
            'teacher_last_name' =>'required',
            'teacher_grade' =>'required',
            'teacher_email' =>['required','unique:teachers'],
            'teacher_phone' =>['required','unique:teachers'],
            'teacher_password' =>['required','min:6'],
            
        ]);
        if($validator->fails()){
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
        }

           
        Teacher::create([
            'teacher_id' => $request->data['teacher_id'],
            'teacher_first_name' => $request->data['teacher_first_name'],
            'teacher_last_name' => $request->data['teacher_last_name'],
            'teacher_grade' => $request->data['teacher_grade'],
            'teacher_email' => $request->data['teacher_email'],
            'teacher_phone' => $request->data['teacher_phone'],
            'teacher_password' => Hash::make($request->data['teacher_password']),
            'remember_token' => $request->_token
        ]);

        return response()->json(['status' => true]);
    }





    public function edit(Request $request)
    {
        
        $teacher = Teacher::find($request->teacher_id);
        if($teacher==false) {
            return response()->json(['status' => false,'message'=>'Something went wrong']);
        }
        $view=view('admin.teacher.edit_form')->with('teacher', $teacher)->render();
        return response()->json(['status' => true,'view'=>$view]);
        
    }


    public function update(Request $request)
    {
        try {
            $teacher = Teacher::find($request->data['teacher_old_id']);
        } catch (\Throwable $th) {
            throw $th;
        }

        
        if($teacher==false) {
            return response()->json(['status' => false,'message'=>'Something went wrong']);
        }
       
       
        $validator=Validator::make($request->data,[
            'teacher_id' =>['required','numeric',"unique:teachers,teacher_id,$teacher->teacher_id,teacher_id"],
            'teacher_first_name' =>'required',
            'teacher_last_name' =>'required',
            'teacher_grade' =>'required',
            'teacher_email' =>['required',"unique:teachers,teacher_email,$teacher->teacher_id,teacher_id"],
            'teacher_phone' =>['required',"unique:teachers,teacher_phone,$teacher->teacher_id,teacher_id"],
        ]);
        if($validator->fails()){
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
        }
      
            $teacher->update([
                'teacher_id' => $request->data['teacher_id'],
                'teacher_first_name' => $request->data['teacher_first_name'],
                'teacher_last_name' => $request->data['teacher_last_name'],
                'teacher_grade' => $request->data['teacher_grade'],
                'teacher_email' => $request->data['teacher_email'],
                'teacher_phone' => $request->data['teacher_phone'],
                'remember_token' => $request->_token
            ]);
      
       
            
        $view=view('admin.teacher.create_form')->render();
        return response()->json(['status' => true,'view'=>$view]);
    }


    public function destroy(Request $request)
    {

        $teacher = Teacher::find($request->teacher_id);
        if($teacher==false) {
            return response()->json(['status' => false,'message'=>'Something went wrong','errors'=>'Teacher not found']);
        }
        $teacher->delete();
        
        return response()->json(['status' => true]);
        
        
    }
    public function editTeacherPassword($teacher_id)
    {
        
        $this->getUsernameAndCount();
             
        $data = [
            'username' => $this->username,
            'count' => $this->count,
            'teacher_id'=>$teacher_id
        ];
       return view('admin.teacher.update_teacher_password')->with($data);
        
    }

    public function updateTeacherPassword(Request $request)
    {
        $teacher= Teacher::find($request->teacher_id);
        if($teacher==false) {
            abort('Teacher not found');
        }
        
        $validator=Validator::make($request->all(),[
            'teacher_new_password' => 'required|confirmed|min:6'
        ]);

        
        if($validator->fails()){
        return redirect()->back()->withError($validator);
        }

        $teacher->update([
            'teacher_password' =>Hash::make($request->password)
        ]);
        return redirect(route('manageTeacher'))->withSuccess('Password changed successfully');  
    }
}
