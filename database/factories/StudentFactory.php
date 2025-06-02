<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentPreference;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        // 1) Pick a programme first
        $programme = $this->faker->randomElement(['BCS','BIT']);

        // 2) Based on the chosen programme, pick the specialization
        if ($programme === 'BCS') {
            // specializations available only for BCS
            $specialization = $this->faker->randomElement([
                'Artificial Intelligence',
                'Security in Digital System',
                'Data Engineering',
                'Network and Data Communications',
            ]);
        } else {
            // programme === 'BIT', use a different set
            $specialization = $this->faker->randomElement([
                'Cybersecurity',
                'Cloud Computing & System Paradigm',
                'Innovative Digital Experience (IDEx)',
                'Data Analytics',
                'Digital Transformation',
            ]);
        }

        return [
            'user_id'        => User::factory(),              // auto–create a User
            'matric_no'      => $this->faker->unique()->numberBetween(2000000, 2500000),
            'st_name'        => $this->faker->name(),
            'st_email'       => $this->faker->unique()->safeEmail(),
            'st_password'    => bcrypt('studentpass'),        // dummy password
            'year'           => $this->faker->numberBetween(1, 4),
            'sem'            => $this->faker->numberBetween(1, 2),
            'programme'      => $programme,
            'specialization' => $specialization,
            'current_cgpa'   => $this->faker->randomFloat(2, 2.0, 4.0),
            'target_cgpa'    => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem1'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem1'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem2'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem2'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem3'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem3'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem4'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem4'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem5'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem5'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem6'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem6'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem7'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem7'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'gpa_sem8'       => $this->faker->randomFloat(2, 2.0, 4.0),
            'cgpa_sem8'      => $this->faker->randomFloat(2, 2.0, 4.0),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Student $student) {
            // Create 3 random preferences for this newly created student
            StudentPreference::factory()
                ->count(3)
                ->state(fn (array $attrs) => [
                    'matric_no' => $student->matric_no,
                    'action'    => 'add',        // if you want all “add” actions
                ])
                ->create();
        });
    }
}