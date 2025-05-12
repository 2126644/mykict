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
        'specialization',
        'current_cgpa',
        'target_cgpa',
        'gpa_sem1', 'cgpa_sem1',
        'gpa_sem2', 'cgpa_sem2',
        'gpa_sem3', 'cgpa_sem3',
        'gpa_sem4', 'cgpa_sem4',
        'gpa_sem5', 'cgpa_sem5',
        'gpa_sem6', 'cgpa_sem6',
        'gpa_sem7', 'cgpa_sem7',
        'gpa_sem8', 'cgpa_sem8',

    ];

    //relationships - NANTI BARU BUKAK BALIK
    public function preferences()
    {
        return $this->hasMany(StudentPreference::class, 'matric_no');
    }

    // public function calculateCGPA()
    // {
    //     return $this->hasMany(CGPACalculator::class, 'matric_no');
    // }
}
