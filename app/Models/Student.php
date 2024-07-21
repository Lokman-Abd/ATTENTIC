<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Student extends Authenticatable
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    protected $table = 'students';
    public $timestamps=false;
    protected $fillable = [
        'student_id',
        'student_first_name',
        'student_last_name', 
        'student_password', 
        'student_email', 
        'group_id',
    ];
    // protected $hidden = [
    //     'student_password',
    // ];
    protected $guard = 'student';

    
    public function getAuthPassword()
    {
        return $this->student_password;
    }
    public function MissStudies()
    {
        return $this->belongsToMany('App\Models\Study','absences','student_id','study_id','student_id','study_id');
    }
    public function absences(){
        return $this->hasMany('App\Models\Absence','student_id','student_id');
    }

    public function justifications()
    {
        return $this->hasMany('App\Models\Justification','student_id','student_id');
    }
    

    public function group()
    {
        return $this->belongsTo('App\Models\Group','group_id','group_id');   
    }

    public function getMyStatusInThisDate($date)
    {
       $res= $this->absences()->whereRelation('session', 'sessions.session_date', '=', $date)->get()->first();
        
       
        
    //    $st=(object) collect(['status' => 'present'])->all();
       $col=(object) collect(['status' => 'present'])->all();
       // $col->put("pivot",'lok');
       // return $res->isEmpty() ? $col : $res;
       
       return $res==null ? $col  : $res;
        // // $absences=$this->absences()->get();

        // return $this->absences()->first()->session;
        // // return $this->absences()->get();
        // // foreach ( $absences as $absence) {
        // //     var_dump($absence->session->session_id);
        // // }
        // return;
        // // return $this->MissStudies()->get();
    }
    public static function getAllStudentsNumber(){
        return self::get()->count();
    }
}
