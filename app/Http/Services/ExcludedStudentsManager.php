<?php

namespace App\Http\Services;
use App\Models\Absence;

class ExcludedStudentsManager
{
    public function getExcludedStudents() {
        $excludedStudents= Absence::getExcludedStudents();
        return $excludedStudents;
    }
}