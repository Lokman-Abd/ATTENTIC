<?php
namespace App\Models;

use App\Traits\UserHandler;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Student extends Authenticatable
{
    use HasFactory;
    use UserHandler;
    protected $fillable = [
        'card_number',
        'first_name',
        'last_name', 
        'password', 
        'email', 
        'group_id',
    ];
    // protected $hidden = [
    //     'password',
    // ];
    protected $guard = 'student';



    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function sessionDate(){
        // absences
        return $this->belongsToMany(SessionDate::class);
    }
    
    function justifications(){
        return $this->hasMany(Justification::class);
    }
    
    // TODO fix this after you remove study model
    // public function MissStudies()
    // {
    //     return $this->belongsToMany(Study::class,'absences','id','study_id','id','study_id');
    // }
    // public function justifications()
    // {
    //     return $this->hasMany(Justification::class);
    // }

    // TODO move this function 
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
    // TODO move also this function 
}
