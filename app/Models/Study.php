<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Study extends Pivot
{
    use HasFactory;
    protected $primaryKey = 'study_id';
    protected $table = 'study';
    protected $fillable = [
        'study_id',
        'session_id',
        'group_teaching_id',
    ];

    public function group_Teaching()
    {
        return $this->hasOne('App\Models\Gr_Teaching', 'group_teaching_id', 'group_teaching_id');
    }
    
    public function session()
    {
        return $this->hasOne('App\Models\Session', 'session_id', 'session_id');
    }
    public function absentStudents()
    {
        return $this->belongsToMany('App\Models\Student','absences','study_id','student_id','study_id','student_id')->withPivot('status');
    }
 
    public function absences(){
        return $this->hasMany('App\Models\Absence','study_id','study_id');
    }
    public function group(){
        return $this->hasOneThrough('App\Models\Group','App\Models\Gr_Teaching','group_teaching_id','group_id','group_teaching_id','group_id');
    }

    public function presentStudents(){
        return $this->group->students()->whereNotIn('student_id',$this->absentStudents->pluck('student_id')->toArray());
    }
    public function getStudentStatus($student_id){
        $res= $this->absentStudents()->where('absences.student_id','=',$student_id)->get()->first();
        
        $st=(object) collect(['status' => 'present'])->all();
        $col=(object) collect(['pivot' => $st])->all();
        return $res==null ? $col  : $res;
    }
    public static function getStudyByDateAndGroup($date,$group){
        // $res= $this->whereRelation('session', 'sessions.session_date', '=', '2022-11-09 12:00:00')->get()->first();
        $res= self::whereRelation('session', 'sessions.session_date', '=', $date)->whereRelation('group', 'groups.group_id', '=', $group)->get()->first();
    //    return $this->session()->where('session_date','=',$date)->get();
        // return self::with('session')->where('session_date', '2022-11-09 12:00:00')->get();
        return $res;
    }

    // public static function TeacherStudies($teacher_id){
    //     return self::join('sessions', 'sessions.session_id', '=', 'study.session_id')
    //     ->join('gr_teaching', 'study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
    //     ->join('teaching', 'gr_teaching.teaching_id', '=', 'teaching.teaching_id')
    //     ->where('teaching.teacher_id', '=', $teacher_id)
    //     ->get();
    // }
    public static function CoursForTeacher($study_id){
        $study= self::find($study_id);
        $session_date= $study->session->session_date;
        $teaching_id= $study->group_Teaching->teaching_id;
        return self::join('sessions', 'sessions.session_id', '=', 'study.session_id')
        ->join('gr_teaching', 'study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
        ->where('sessions.session_date', '=', $session_date)
        ->where('gr_teaching.teaching_id', '=', $teaching_id)
        ->get();
    }
    public static function studiesOfTeacher($teacher_id){
        return self::
            join('gr_teaching', 'study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
            ->join('teaching', 'gr_teaching.teaching_id', '=', 'teaching.teaching_id')
            ->where('teaching.teacher_id', '=', $teacher_id)
            ->get()->count();
    }

}
