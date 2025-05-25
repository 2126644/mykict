<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPreference extends Model
{
    protected $primaryKey = 'preference_id';
    public $incrementing = true;

    protected $fillable = [
        'matric_no',
        'course_code',
        'course_title',
        'credit_hrs',
        'action',
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
