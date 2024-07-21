<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Authenticatable
{
    use HasFactory;
    protected $primaryKey = 'teacher_id';
    protected $table = 'teachers';
    protected $fillable = [
        'teacher_id',
        'teacher_first_name',
        'teacher_last_name',
        'teacher_grade',
        'teacher_email',
        'teacher_phone',
        'teacher_password',
        'remember_token'
    ];
    protected $hidden = [
        'remember_token'
    ];
    public $timestamps=false;
    protected $guard = 'teacher';
    
    public function getAuthPassword()
    {
        return $this->teacher_password;
    }
    public function teachTyping(){
        return $this->belongsToMany('App\Models\Typing','teaching','teacher_id','typing_id','teacher_id','typing_id');
    }
    public function teachings(){
        return $this->hasMany('App\Models\Teaching','teacher_id','teacher_id');
    }
    // public function groupTeaching()
    // {
    //     return $this->teachings()->with('teachGroup.students');

    // }
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
    public static function getAllTeachersNumber(){
        return self::get()->count();
    }
    public static function studiesOfTeacher($teacher_id){
        return self::join('teaching', 'teachers.teacher_id', '=', 'teaching.teacher_id')
        ->join('gr_teaching', 'teaching.teaching_id', '=', 'gr_teaching.teaching_id')
        ->join('study','study.group_teaching_id', '=', 'gr_teaching.group_teaching_id')
        ->where('teaching.teacher_id', '=', $teacher_id)
        ->get()->count();
    }
}
