<?php

namespace Database\Factories;

use App\Models\StudentPreference;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentPreferenceFactory extends Factory
{
    protected $model = StudentPreference::class;

    public function definition()
    {

        // 2) Pick a random Course model (so we can read code, title, credit_hours)
        $course = Course::inRandomOrder()->first();

        return [
            
            'course_code'   => $course->course_code,
            'course_title'  => $course->course_title,   // pulled from the Course model
            'credit_hrs'    => $course->credit_hrs,
            'action'        => 'add',
            'created_at'    => $this->faker->dateTimeBetween('-6 months','now'),
            'updated_at'    => now(),
        ];
    }
}
