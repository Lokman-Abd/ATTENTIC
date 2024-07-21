<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;   

class Admin extends Authenticatable 
{

    use HasFactory;
    protected $primaryKey = 'admin_id';
    public $timestamps = false;
    protected $table = 'admins';
    protected $fillable = [
        'admin_id',
        'admin_first_name',
        'admin_last_name',
        'admin_password',
        'admin_email',

    ];
    protected $guard = 'admin';

   

    public function getAuthPassword()
    {
        return $this->admin_password;
    }
    
}
