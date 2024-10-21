<?php

namespace App\Models;

use App\Traits\UserHandler;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Authenticatable
{
    use UserHandler;
    use HasFactory;
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'grade',
        'email',
        'phone',
        'password',
        'remember_token'
    ];
    protected $hidden = [
        'remember_token'
    ];
    protected $guard = 'teacher';
    
    public function module_SessionType(){
        return $this->belongsToMany(Module_SessionType::class);
    }
    // public function teachings(){
    //     return $this->hasMany('App\Models\Teaching','id','id');
    // }
    // public function groupTeaching()
    // {
    //     return $this->teachings()->with('teachGroup.students');

    // }
    // TODO move this logic into another class
    public static function classesOfTeacher($teacher_id)
    {
        return self::find($teacher_id)
        ->join('teaching','teachers.teacher_id', '=', 'teaching.teacher_id')
        ->join('gr_teaching','gr_teaching.teaching_id', '=', 'teaching.teaching_id')
        ->where('teaching.teacher_id',$teacher_id)
        ->count();

    }

    public static function StudentsOfTeacher($teacher_id){
        return self::find($teacher_id)
        ->join('teaching','teachers.teacher_id', '=', 'teaching.teacher_id')
        ->join('gr_teaching','gr_teaching.teaching_id', '=', 'teaching.teaching_id')
        ->join('students','students.group_id', '=', 'gr_teaching.group_id')
        ->groupBy('students.student_id')
        ->select('students.student_id')
        ->get()->count();
    }
    public static function studiesOfTeacher($teacher_id){
        return self::join('teaching', 'teachers.teacher_id', '=', 'teaching.teacher_id')
        ->join('gr_teaching', 'teaching.teaching_id', '=', 'gr_teaching.teaching_id')
        ->join('study','study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
        ->where('teaching.teacher_id', '=', $teacher_id)
        ->get()->count();
    }
}
