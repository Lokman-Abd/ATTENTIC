<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $primaryKey = 'module_id';
    protected $table = 'modules';
    public $timestamps = false;
    protected $fillable = [
        'module_id',
        'module_name',
        'short_cut'
    ];

    public function types()
    {
        return $this->belongsToMany('App\Models\Type','typing','module_id','type_id','module_id','type_id');
        
    }

    public function typings(){
        return $this->hasMany('App\Models\Typing','module_id','module_id');
    }
    public static function getAllModulesNumber(){
        return self::get()->count();
    }
}
