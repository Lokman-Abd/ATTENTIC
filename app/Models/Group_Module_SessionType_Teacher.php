<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Group_Module_SessionType_Teacher extends Pivot
{
    use HasFactory;
    protected $table = 'gr_mod_type_teacher';
    protected $fillable = [
        'id',
        'module_sessionType_teacher_id',
        'group_id',
    ];
    function sessionDate()  {
        return $this->hasMany(SessionDate::class);
    }
    
    // public function teaching()
    // {
    //     return $this->hasOne('App\Models\Teaching', 'teaching_id', 'teaching_id');
    // }
    // public function group()
    // {
    //     return $this->hasOne('App\Models\Group', 'group_id', 'group_id');
    // }
    // public function Typing()
    // {
    //     return $this->hasOneThrough('App\Models\Typing','App\Models\Teaching','teaching_id','typing_id','teaching_id','typing_id');
    // }


    // public function study()
    // {
    //     return $this->belongsToMany('App\Models\Session','study','group_teaching_id','seTession_id','group_teaching_id','session_id');
    // }
    // public static function getAllGroupTeaching(){
    //     return self::get()->count();
    // }

}
