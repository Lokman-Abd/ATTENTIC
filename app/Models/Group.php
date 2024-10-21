<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
    ];
    
    public function module_SessionType_Teacher()
    {
        return $this->belongsToMany(Module_SessionType_Teacher::class); 
    }
    // public function Gr_Teachings()
    // {
    //     return $this->hasMany('App\Models\Gr_Teaching', 'id', 'id');
    // }
    public function students()
    {
        return $this->hasMany(Student::class);
    }

}
