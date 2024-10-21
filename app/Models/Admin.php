<?php

namespace App\Models;

use App\Traits\UserHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;   

class Admin extends Authenticatable 
{
    use UserHandler;
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'password',
        'email',
    ];
    
}
