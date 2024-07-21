<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Typing extends Pivot
{
    use HasFactory;
    protected $primaryKey = 'typing_id';
    protected $table = 'typing';
    protected $fillable = [
        'typing_id',
        'type_id',
        'module_id',
       
    ];

        public function teachedBy()
        {
            return $this->belongsToMany('App\Models\Teacher','teaching','typing_id','teacher_id','typing_id','teacher_id');
        }
        public function module()
        {
            return $this->hasOne('App\Models\Module','module_id','module_id');
        }
        public function type()
        {
            return $this->hasOne('App\Models\Type','type_id','type_id');
        }
        public function teaching(){
            return $this->hasMany('App\Models\Teaching','typing_id','typing_id');
        }


}
