<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'short_cut'
    ];

    // public function types()
    // {
    //     return $this->belongsToMany('App\Models\Type','typing','id','type_id','id','type_id');   
    // }
    
    public function sessionTypes(){
        return $this->belongsToMany(SessionType::class);
    }
}
