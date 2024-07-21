<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $primaryKey = 'group_id';
    protected $fillable = [
        'group_id',
        'group_name',
    ];
    public function teachedBy()
    {
        return $this->belongsToMany('App\Models\Teaching','gr_teaching','group_id','teaching_id','group_id','teaching_id');
        
    }
    public function Gr_Teachings()
    {
        return $this->hasMany('App\Models\Gr_Teaching', 'group_id', 'group_id');
    }
    public function students()
    {
        return $this->hasMany('App\Models\Student', 'group_id', 'group_id');
    }

}
