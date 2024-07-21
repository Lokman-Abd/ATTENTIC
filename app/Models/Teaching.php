<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Teaching extends Pivot
{
    use HasFactory;
    protected $primaryKey = 'teaching_id';
    protected $table = 'teaching';
    protected $fillable = [
        'teaching_id',
        'typing_id',
        'teacher_id',
    ];
    public function teacher()
    {
        return $this->hasOne('App\Models\Teacher', 'teacher_id', 'teacher_id');
    }
    public function typing()
    {
        return $this->hasOne('App\Models\Typing', 'typing_id', 'typing_id');
    }

    public function teachGroup()
    {
        return $this->belongsToMany('App\Models\Group','gr_teaching','teaching_id','group_id','teaching_id','group_id');
    }
    
    public function Gr_Teachings()
    {
        return $this->hasMany('App\Models\Gr_Teaching', 'group_teaching_id', 'group_teaching_id');
    }
}
