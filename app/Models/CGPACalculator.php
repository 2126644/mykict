<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CGPACalculator extends Model
{
    protected $primaryKey = 'calculation_id';
    public $incrementing = true;

    protected $fillable = [
        'matric_no',
        'course_code', 
        'grade', 
        'semester', 
        'credit_completed',
        'current_cgpa', 
        'new_gpa', 
        'new_cgpa'
    ];

    //relationships
    public function student()
    {
    return $this->belongsTo(Student::class, 'matric_no');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code');
    }
}
