<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentPreference;
use App\Models\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        {

        // 2) Create 50 students (along with their users and 3 preferences each)
        Student::factory()
            ->count(50)
            ->create();

        // (No need to separately call StudentPreference::factory()—that’s done in afterCreating.)
    }
}
}