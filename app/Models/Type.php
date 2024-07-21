<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    protected $primaryKey = 'type_id';
    protected $table = 'types';
    public $timestamps = false;
    protected $fillable = [
        'type_id',
        'type',
    ];
    
    public function modules()
    {
        return $this->belongsToMany('App\Models\Module','typing','type_id','module_id','type_id','module_id')->withPivot('typing_id');
    }

    public function typings(){
        return $this->hasMany('App\Models\Typing','type_id','type_id');
    }

    public function hasThisModule($module_id){
       $res= $this->typings()->where('typing.module_id', '=',$module_id)->get();
    //    return $res==null ? true : false;
       return $res->isNotEmpty();
    }
    
}
