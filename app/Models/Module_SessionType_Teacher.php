<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Module_SessionType_Teacher extends Pivot
{
    use HasFactory;
    protected $table = 'module_sessionType_teacher';
    protected $fillable = [
        'id',
        'module_sessionType_id',
        'teacher_id',
    ];
    
    // public function teacher()
    // {
    //     return $this->hasOne('App\Models\Teacher', 'teacher_id', 'teacher_id');
    // }
    // public function typing()
    // {
    //     return $this->hasOne('App\Models\Typing', 'typing_id', 'typing_id');
    // }

    public function groupe()
    {
        return $this->belongsToMany(Group::class);
    }
    
    // public function Gr_Teachings()
    // {
    //     return $this->hasMany('App\Models\Gr_Teaching', 'group_teaching_id', 'group_teaching_id');
    // }
}
