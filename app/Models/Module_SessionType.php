<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Module_SessionType extends Pivot
{
    use HasFactory;
    protected $table = 'module_sessionType';
    protected $fillable = [
        'id',
        'sessionType_id',
        'module_id',
       
    ];
    
    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }
    // public function module()
    // {
    //     return $this->hasOne(Module::class);
    // }
    // public function type()
    // {
    //     return $this->hasOne(SessionType::class);
    // }
    // public function module_SessionType_Teacher(){
    //     return $this->belongsToMany(Module_SessionType_Teacher::class);
    // }


}
