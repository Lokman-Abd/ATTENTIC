<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'id',
        'sessionDate_id',
        'student_id',
        'status',
    ];


    
    // public function study()
    // {
    //     return $this->hasOne('App\Models\Study', 'study_id', 'study_id');
    // }
    // public function student()
    // {
    //     return $this->hasOne('App\Models\Student', 'student_id', 'student_id');
    // }
    // public function session()
    // {
    //     return $this->hasOneThrough('App\Models\Session', 'App\Models\Study', 'study_id', 'session_id', 'study_id', 'session_id');
    // }
    // public function groupTeaching()
    // {
    //     return $this->hasOneThrough('App\Models\Gr_Teaching', 'App\Models\Study', 'study_id', 'group_teaching_id', 'study_id', 'group_teaching_id')->first();
    // }
    public static function getAbsentStudentsNumberToday()
    {
        return DB::table('absences')
            ->join('study', 'absences.study_id', '=', 'study.study_id')
            ->join('sessions', 'sessions.session_id', '=', 'study.session_id')
            ->join('students', 'absences.student_id', '=', 'students.student_id')
            ->where('sessions.session_date', 'like', '%' . date("Y-m-d") . '%')
            ->select('students.student_id')
            ->groupBy('students.student_id')
            ->get()->count();
    }
    public static function getEmailAbsentStudentsToday()
    {
        return DB::table('absences')
            ->join('study', 'absences.study_id', '=', 'study.study_id')
            ->join('sessions', 'sessions.session_id', '=', 'study.session_id')
            ->join('gr_teaching', 'study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
            ->join('teaching', 'gr_teaching.teaching_id', '=', 'teaching.teaching_id')
            ->join('teachers', 'teaching.teacher_id', '=', 'teachers.teacher_id')
            ->join('typing', 'teaching.typing_id', '=', 'typing.typing_id')
            ->join('modules', 'typing.module_id', '=', 'modules.module_id')
            ->join('types', 'typing.type_id', '=', 'types.type_id')
            ->join('students', 'absences.student_id', '=', 'students.student_id')
            ->where('sessions.session_date', 'like', '%' . date("Y-m-d") . '%')
            ->select('students.student_email', 'students.student_first_name', 'students.student_last_name', 'students.student_email', 'types.type', 'modules.short_cut', 'sessions.session_date', 'students.group_id', 'teachers.teacher_first_name', 'teachers.teacher_last_name')
            ->get();
    }
    // TODO this logic hould copied into another class
    public static function getAbsentPercentage()
    {
        $absence_this_month = self::whereRelation('session', 'sessions.session_date', 'like', '%' . date("Y-m") . '%')->get()->count();
        $absence_last_month = self::whereRelation('session', 'sessions.session_date', 'like', '%' . date("Y-m", strtotime("last month")) . '%')->get()->count();
        if (!($absence_this_month == 0)) {
            return round(($absence_this_month - $absence_last_month) * 100 / $absence_this_month);
        }else{
            return ((-$absence_last_month )*100);
        }
    }

    public static function getAbsencesOfThisStudentBetween($start_date, $end_date, $student_id)
    {
        return self::join('study', 'study.study_id', '=', 'absences.study_id')
            ->join('sessions', 'sessions.session_id', '=', 'study.session_id')
            ->Where('absences.student_id', '=', $student_id)
            ->whereBetween('sessions.session_date', [$start_date, date('Y-m-d', strtotime($end_date . ' +1 day'))])
            ->get()->pluck('id')->toArray();
    }
public static function  getExcludedStudents()
    {
        $res1 = DB::table('absences')
            ->join('study', 'absences.study_id', '=', 'study.study_id')
            ->join('gr_teaching', 'study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
            ->join('teaching', 'gr_teaching.teaching_id', '=', 'teaching.teaching_id')
            ->join('typing', 'teaching.typing_id', '=', 'typing.typing_id')
            ->join('modules', 'typing.module_id', '=', 'modules.module_id')
            ->join('types', 'typing.type_id', '=', 'types.type_id')
            ->join('students', 'absences.student_id', '=', 'students.student_id')
            ->where('status', '=', 0)
            ->select('absences.student_id','student_first_name','student_last_name','students.group_id' ,'modules.short_cut', 'types.type', 'absences.status', DB::raw('count(*) as total'))
            ->groupBy('absences.student_id', 'modules.module_id', 'types.type_id','modules.short_cut', 'types.type', 'absences.status','student_first_name','student_last_name','students.group_id')
            ->having('total', '>=', 3)
            ->having('total', '<=', 4)
            ->get();

        $res2 = DB::table('absences')
            ->join('study', 'absences.study_id', '=', 'study.study_id')
            ->join('gr_teaching', 'study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
            ->join('teaching', 'gr_teaching.teaching_id', '=', 'teaching.teaching_id')
            ->join('typing', 'teaching.typing_id', '=', 'typing.typing_id')
            ->join('modules', 'typing.module_id', '=', 'modules.module_id')

            ->join('types', 'typing.type_id', '=', 'types.type_id')
            ->join('students', 'absences.student_id', '=', 'students.student_id')
            ->select('absences.student_id','student_first_name','student_last_name','students.group_id', 'modules.short_cut', 'types.type', DB::raw('count(*) as total'))
            ->groupBy('absences.student_id', 'modules.module_id', 'types.type_id', 'modules.short_cut', 'types.type','student_first_name','student_last_name','students.group_id')
            ->having('total', '>', 4)
            ->get();
        return collect($res1)->merge($res2);
    }
}
