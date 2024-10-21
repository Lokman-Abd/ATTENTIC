<?php

namespace App\Traits;

trait UserHandler
{
    public function getFullName()  {
        return $this["first_name"].' '.$this["last_name"];
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}