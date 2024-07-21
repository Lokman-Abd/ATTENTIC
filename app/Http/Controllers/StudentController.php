<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected $count;
    
    protected $username;

    public function getUsernameAndCount(){
        $this->count = Justification::where('justification_status','=','0')->count();
        $this->username= Auth::guard('admin')->user()->admin_first_name . ' '.Auth::guard('admin')->user()->admin_last_name;
    }

    public function manage()
    {
        $this->getUsernameAndCount();

        $students = Student::all();
        $data = [
            'username' => $this->username,
            'students'   => $students,
            'count' => $this->count
        ];

        
        return view('admin.student.manageStudent')->with($data);
    }


    public function store(Request $request)
    {
        $validator=Validator::make($request->data,[
            'student_id' =>['required','unique:students','numeric'],
            'student_first_name' =>'required',
            'student_last_name' =>'required',
            'student_email' =>['required','unique:students'],
            'group_id' =>['required','exists:groups,group_id'],
            'student_password' =>['required','min:6'],
            
        ]);
        if($validator->fails()){
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
        }

           
        Student::create([
            'student_id' => $request->data['student_id'],
            'student_first_name' => $request->data['student_first_name'],
            'student_last_name' => $request->data['student_last_name'],
            'group_id' => $request->data['group_id'],
            'student_email' => $request->data['student_email'],
            'student_password' => Hash::make($request->data['student_password']),
            'remember_token' => $request->_token
        ]);

        return response()->json(['status' => true]);
    }
    public function edit(Request $request)
    {
        
        $student = Student::find($request->student_id);
        if($student==false) {
            return response()->json(['status' => false,'message'=>'Something went wrong']);
        }
        $view=view('admin.student.edit_form')->with('student', $student)->render();
        return response()->json(['status' => true,'view'=>$view]);
        
    }


    public function update(Request $request)
    {
        try {
            $student = Student::find($request->data['student_old_id']);
        } catch (\Throwable $th) {
            throw $th;
        }

        
        if($student==false) {
            return response()->json(['status' => false,'message'=>'Something went wrong']);
        }
       
       
        $validator=Validator::make($request->data,[
            'student_id' =>['required','numeric',"unique:students,student_id,$student->student_id,student_id"],
            'student_first_name' =>'required',
            'student_last_name' =>'required',
            'group_id' =>['required','exists:groups,group_id'],
            'student_email' =>['required',"unique:students,student_email,$student->student_id,student_id"],
        ]);
        if($validator->fails()){
            return response()->json(['status' => false,'message'=>'Something went wrong', 'errors' => $validator->errors()]);
        }
      
            $student->update([
                'student_id' => $request->data['student_id'],
                'student_first_name' => $request->data['student_first_name'],
                'student_last_name' => $request->data['student_last_name'],
                'group_id' => $request->data['group_id'],
                'student_email' => $request->data['student_email'],
                'remember_token' => $request->_token
            ]);
      
       
            
        $view=view('admin.student.create_form')->render();
        return response()->json(['status' => true,'view'=>$view]);
    }


    public function destroy(Request $request)
    {

        $student = Student::find($request->student_id);
        if($student==false) {
            return response()->json(['status' => false,'message'=>'Something went wrong','errors'=>'Student not found']);
        }
        $student->delete();
        
        return response()->json(['status' => true]);
        
        
    }
    public function editStudentPassword($student_id)
    {
         
       if(!(is_numeric($student_id))){
        abort(404);
       }
        $student= Student::find($student_id);

        if($student==false) {
            abort(404);
        }
        $this->getUsernameAndCount();
             
        $data = [
            'username' => $this->username,
            'student_id'=>$student_id,
            'count' => $this->count
        ];
       return view('admin.student.update_student_password')->with($data);
        
    }

    public function updateStudentPassword(Request $request)
    {
        $student= Student::find($request->student_id);
        if($student==false) {
            abort('Student not found');
        }
        $validator=Validator::make($request->all(),[
            'student_new_password' => 'required|confirmed|min:6'
        ]);
        
        if($validator->fails()){
        return redirect()->back()->withError($validator);
        }

        $student->update([
            'student_password' =>Hash::make($request->password)
        ]);
        return redirect(route('manageStudent'))->withSuccess('Password changed successfully');  
    }
    public function displayExcludedStudents() {
        $excludedStudents= Absence::getExcludedStudents();
        $this->getUsernameAndCount();
             
        $data = [
            'username' => $this->username,
            'count' => $this->count,
            'excludedStudents' => $excludedStudents
        ];
        // return $excludedStudents;
        return view('admin.show_excluded_students')->with($data);

    }
}
