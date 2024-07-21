<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    use HasFactory;
    protected $table = 'justifications';
    protected $primaryKey = 'justification_id';
    public $timestamps=false;
    protected $fillable = [
        'justification_id',
        'student_id',
        'img_path',
        'justification_status',
        'start_at',
        'end_at',
    ];
    public function teachedBy()
    {
        return $this->belongsToMany('App\Models\Teaching','gr_teaching','group_id','teaching_id','group_id','teaching_id');
        
    }
    public function Gr_Teachings()
    {
        return $this->hasMany('App\Models\Gr_Teaching', 'group_teaching_id', 'group_teaching_id');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student','student_id','student_id');   
    }
}
