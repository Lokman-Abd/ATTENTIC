<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type',
    ];
    
    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }

    // public function typings(){
    //     return $this->hasMany('App\Models\Typing','id','id');
    // }

    // TODO remove this to other class
    public function hasThisModule($module_id){
       $res= $this->typings()->where('typing.module_id', '=',$module_id)->get();
    //    return $res==null ? true : false;
       return $res->isNotEmpty();
    }
    
}
