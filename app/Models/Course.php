<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_code';
    public $incrementing = false;   //manually assigned course_id
    protected $keyType = 'string';

    protected $fillable = [
        'course_code',
        'course_title',
        'credit_hrs',
        'department',
        'pre_requisites',
        'year',
        'sem',
        'specialization',
        'category',
        'programme'
    ];

    //relationships
    public function preferences()
    {
        return $this->hasMany(StudentPreference::class, 'course_code');
    }

    public function calculateCGPA()
    {
        return $this->hasMany(CGPACalculator::class, 'course_code');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function courses()
{
    return $this->hasMany(Student::class, 'student_preferences', 'course_code', 'matric_no');
}
}
