<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'matric_no';
    public $incrementing = false;   //manually assigned matric_no
    protected $keyType = 'int';

    protected $fillable = [
        'matric_no',
        'st_name',
        'st_email',
        'st_password',
        'year',
        'sem',
        'major',
        'current_cgpa',
    ];

    //relationships
    public function preferences()
    {
        return $this->hasMany(StudentPreference::class, 'matric_no');
    }

    public function calculateCGPA()
    {
        return $this->hasMany(CGPACalculator::class, 'matric_no');
    }
}
