<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Group;
use App\Models\Study;
use App\Models\Typing;
use App\Models\Absence;
use App\Models\Session;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Teaching;
use App\Models\Gr_Teaching;
use Illuminate\Http\Request;
use App\Models\Justification;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudyController extends Controller
{

    public $username;
    protected $student_status = [
        'absent_without_justification' => 0,
        'absent_with_justification' => 1,
        'present' => 2,
    ];
    protected $all_groups;
    protected $course_id;



    public function getUsername()
    {
        // $this->count = Justification::where('justification_status', '=', '0')->count();
        $this->course_id = Type::where('type', 'like', '%course%')->get()->first()->type_id;
        $this->all_groups = Group::all()->pluck('group_id')->toArray();
        $this->username = Auth::guard('teacher')->user()->teacher_first_name . ' ' . Auth::guard('teacher')->user()->teacher_last_name;
    }

    public function manageStudy()
    {
        $this->getUsername();


        $teacher_id = Auth::guard('teacher')->user()->teacher_id;

        $teachings = Teaching::all()->where('teacher_id', '=', $teacher_id);




        $data = [
            'username' => $this->username,
            'teacher_id' => $teacher_id,
            'teachings' => $teachings,
            'course_id' => $this->course_id,
            'all_groups' => $this->all_groups,
            // 'count' => $this->count
        ];
        return view('teacher.manageStudy')->with($data);
    }
    public function dashboard()
    {
        $this->getUsername();
        $teacher_id = Auth::guard('teacher')->user()->teacher_id;
        $AllStudents = Teacher::StudentsOfTeacher($teacher_id);
        $allClasses =  Teacher::classesOfTeacher($teacher_id);
        $allStudies = Teacher::studiesOfTeacher($teacher_id);
        $data = [
            'username' => $this->username,
            'AllStudents' => $AllStudents,
            'allClasses' => $allClasses,
            'allStudies' => $allStudies,
        ];
        return view('teacher.index')->with($data);
    }


    // public function getModuleAndTypes(Request $request)
    // {
    //     try {
    //         $teacher = Teacher::find($request->id);
    //         $module = $teacher->teachingModule;
    //         $types = $module->types->makeHidden('pivot');;
    //         return response()->json(['status' => true, 'module' => $module, 'types' => $types]);
    //     } catch (\Throwable $th) {
    //         return response()->json(['status' => false, 'errors' => $th->getMessage()]);
    //     }
    // }

    public function storeStudy(Request $request)
    {

        $this->getUsername();

        $session_date =  date('Y-m-d H:i', strtotime($request->session_date . ' ' . $request->session_time));

        // four reformat time
        $request->merge(['session_date' => $session_date]);
        $request->merge(['session_time' => date('i', strtotime($request->session_time))]);


        try {

            $validator = Validator::make($request->all(), [
                'group_ids' => ['required', 'array', 'min:1'],
                'group_ids.*' => ['required', 'exists:groups,group_id'],
                'teaching_id' => ['required', 'exists:teaching'],
                'session_date' => ['required', 'before:' . date('Y-m-d 23:59')],
                'session_time' =>  Rule::in(['30', '00']),
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withError($validator->errors());
            }


            $session = Session::findOrCreate($request->session_date);

            $session->session_date = $request->session_date;
            $session->save();


            if ($session == false) {
                return redirect()->back()->withError('Session not Created');
            }

            $group_teaching_ids = Gr_Teaching::all()->where('teaching_id', '=', $request->teaching_id)->whereIn('group_id', $request->group_ids)->pluck('group_teaching_id')->toArray();

            $data_attached = $session->study()->syncWithoutDetaching($group_teaching_ids)['attached'];


            if (count($data_attached) == 0) {
                return redirect()->back()->withError('The session is already been created');
            }
            $studies = Study::all()->where('session_id', $session->session_id)->whereIn('group_teaching_id', $data_attached);
            // $group_teachings = Gr_Teaching::all()->whereIn('group_teaching_id', $group_teaching_ids);
        } catch (\Throwable $th) {
            return $th->getMessage();
            // return redirect()->back()->withError($th->getMessage());
            return redirect()->back()->withError('Something wrong went happened');
        }
        $data = [
            'username' => $this->username,
            'group_ids' => $request->group_ids,
            'studies' => $studies,
            'session' => $session,
            'student_status' => $this->student_status
        ];

        return view('teacher.takeAttendance')->with($data);
    }



    public function setAbsence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'study_id_of_student'  => ['required', 'array', 'min:1'],
            'status'  => ['required', 'array', 'min:1'],
            'status.*'  => [Rule::in(['0', '1', '2'])],
        ]);
        if ($validator->fails()) {
            // return $validator->errors();
            return redirect()->back()->withError('Oppes! You have entered invalid credentials');
        }
        try {

            $student_ids_status = $request->status;
            $study_ids_student_ids = $request->study_id_of_student;

            $del_val = strval($this->student_status['present']);

            $student_ids_status = array_filter($student_ids_status, function ($e) use ($del_val) {
                return ($e !== $del_val);
            });

            // this array to delete all student are present



            $all_student_ids = array_keys($student_ids_status);
            // get array of only student ids that are not present


            $data = [];
            foreach ($study_ids_student_ids as $study_id => $study_id_student_ids) {
                foreach ($study_id_student_ids as $key_f2 => $student_id) {

                    if (!in_array($student_id, $all_student_ids)) {

                        unset($study_ids_student_ids[$study_id][$key_f2]);
                    } else {
                        $data[$study_id][$student_id] = ['status' => $student_ids_status[$student_id]];
                    }
                }
            }
            // get only the students that are absence with thier study id 

            // get the right data STRUCTURE to combine with the syncWithoutDetaching

            foreach ($data as $study_id => $student_ids) {
                $study = Study::find($study_id);
                $study->absentStudents()->syncWithoutDetaching($student_ids);
            }
            return redirect()->route('manageStudy');
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage());
        }
    }

    public function viewAttendance($module, $type, $group)
    {
        $this->getUsername();
        try {

            if (str_contains(strtoupper($type), 'COURSE')) {
                $group = $this->all_groups;
            } else {
                $group = [$group];
            }
            $typing_id = Type::where('type', '=', $type)->first()->modules->where('short_cut', 'like', $module)->first()->pivot->typing_id;
            $typing = Typing::find($typing_id);
            $teacher_id = Auth::guard('teacher')->user()->teacher_id;
            // $teacher_studies=Study::TeacherStudies($teacher_id);

            $teachings = $typing->teaching->where('teacher_id', '=', $teacher_id)->pluck('teaching_id')->toArray();
            // $teachings = Auth::guard('teacher')->user()->teachings->pluck('teaching_id')->toArray();
            $group_teachings = Gr_Teaching::all()->whereIn('group_id', $group)->whereIn('teaching_id', $teachings)->pluck('group_teaching_id')->toArray();


            $studies = Study::whereIn('group_teaching_id', $group_teachings)
                ->join('sessions', 'sessions.session_id', '=', 'study.session_id')
                ->orderBy('sessions.session_date')
                ->select('study.*') //see PS:
                ->get();

            if (count($studies) == 0) {

                return redirect()->route('manageStudy')->withError('There are No sessions available');
            }
            $absences = Absence::all();
            $data = [
                'username' => $this->username,
                'studies' => $studies,
                'absences' => $absences,
                'group' => $group,
                'student_status' => $this->student_status
            ];



            $validator = Validator::make($data, [
                'username'  => ['required'],
                'studies' => ['required'],

            ]);


            if ($validator->fails()) {

                return redirect()->route('manageStudy')->withError('something wrong happened');
            }
        } catch (\Throwable $th) {
            return redirect()->route('manageStudy')->withError('something wrong happened');
        }

        return view('teacher.allStudentsList')->with($data);
    }
    public function updateAbsenceStatus(Request $request)
    {


        try {
            $study = Study::getStudyByDateAndGroup($request->study_date, Student::find($request->student_id)->group_id);
            $study->absentStudents()->syncWithoutDetaching([$request->student_id => ['status' => $request->status]])['attached'];

            return response()->json(['status' => true, 'message' => 'Status changed Successfully',]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function deleteAbsence(Request $request)
    {
        try {

            $student = Student::find($request->student_id);
            $study = Study::getStudyByDateAndGroup($request->study_date, $student->group_id);
            if ($student->absences->where('study_id', $study->study_id)->first()->delete()) {
                return response()->json(['status' => true, 'message' => 'delete Absent secussfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'faile to delete Absent']);
            }
        } catch (\Throwable $th) {

            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function deleteSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'study_id'  => ['required', 'exists:study,study_id'],
            'is_course'  => [Rule::in(['false', 'true'])],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withError($validator->errors());
        }

        if ($request->is_course == 'true') {
            $studies = Study::CoursForTeacher($request->study_id)->pluck('study_id')->toArray();
            $result = Study::whereIn('study_id', $studies)->delete();
        } else {
            $result = Study::findOrFail($request->study_id)->delete();
        }
        if ($result == false) {
            return redirect()->back()->withError($validator->errors());
        }
        return redirect()->back();
    }
}
