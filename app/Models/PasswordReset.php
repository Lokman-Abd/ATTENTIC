<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    
    // If you don't have timestamps columns like `created_at` or `updated_at`:
    public $timestamps = false;

    // If your table doesn't have an incrementing primary key (like `id`), you might want to disable it:
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'email',
        'token',
        'user_type',
        'created_at',
    ];
        // Automatically set `created_at` to now() when creating a new record
        protected static function boot()
        {
            parent::boot();
    
            static::creating(function ($model) {
                $model->created_at = $model->freshTimestamp();
            });
        }
}
