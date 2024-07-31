<?php

namespace App\Http\Controllers;
use App\Http\Services\ExcludedStudentsManager;
use App\Models\Group;
use App\Models\Absence;
use App\Models\Student;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Requests\StudentFrom;

class StudentController extends Controller
{
    private $excludedStudentsManager;
    use GeneralTrait;
    public function __construct( ExcludedStudentsManager $excludedStudentsManager) {
        $this->excludedStudentsManager = $excludedStudentsManager;
    }

    public function index()
    {
        $students =Student::with("group")->get();
        $groups = Group::all();
        $data = [
            'students'   => $students,
            'groups'=>$groups
        ];
        return view('admin.student.manageStudent')->with($data);
    }


    public function store(StudentFrom $request)
    {
        Student::create($request->validated());
        return redirect(route('students.index'))->withSuccess("Student Added Successfully");
    }
    public function edit(Student $student)
    {
        $groups = Group::all();
        $data = [
            'student'   => $student,
            'groups'=>$groups
        ];
        return view('admin.student.editStudent')->with($data);        
    }


    public function update(Student $student,StudentFrom $request)
    {      
        $student->update($request->only(
            ['student_card',
            'student_first_name',
            'student_last_name',
            'group_id',
            'student_email']));
        return redirect(route('students.index'))->withSuccess("Student Updated Successfully");
    }


    public function destroy(Student $student)
    {
        // TODO Fix Gates for only admin
        $student->delete();   
        return redirect(route('students.index'))->withSuccess("Student Deleted Successfully");        
    }
    public function editStudentPassword(Student $student)
    {
        $data = [
            'student_id'=>$student->student_id,
        ];
       return view('admin.student.update_student_password')->with($data);
        
    }

    public function updateStudentPassword(Student $student,Request $request)
    {
        // TODO add only admin or student can change password 
        $request->validate([
            'student_new_password' => 'required|confirmed|min:6'
        ]);
        $student->update([
            'student_password' =>bcrypt($request->password)
        ]);
        return redirect(route('students.index'))->withSuccess('Password changed successfully');  
    }
    
    public function displayExcludedStudents() {
        $excludedStudents=$this->excludedStudentsManager->getExcludedStudents();
        $data = [
            'excludedStudents' => $excludedStudents
        ];
        return view('admin.show_excluded_students')->with($data);
        

    }
}
