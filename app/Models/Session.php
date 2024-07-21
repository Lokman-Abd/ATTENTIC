<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $primaryKey = 'session_id';
    protected $table = 'sessions';
    public $timestamps=false;
    protected $fillable = [
        'session_id',
        'session_date'
    ];
    public function study()
    {
        return $this->belongsToMany('App\Models\Gr_Teaching','study','session_id','group_teaching_id','session_id','group_teaching_id');
    }
    // do not delete this because it is trueeeeeeeeeeeeeee
    public function get_studies(){
        return $this->hasMany('App\Models\Study','session_id','session_id');
    }
    public static function findOrCreate($date)
{
    $obj = static::where('session_date', $date)->get()->first();
    return $obj ?: new static;
}
    
}
