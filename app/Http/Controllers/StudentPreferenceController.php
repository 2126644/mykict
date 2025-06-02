<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;


class StudentPreferenceController extends Controller
{
    // Show the “suggested” + “already selected” courses
    public function showRecommendedCourses(Request $request)
    {
        $student = Auth::user()->student; // returns null or a Student model
        if (! $student) {
            abort(404);
        }

        // Calculate next semester/year
        $currentYear = $student->year;
        $currentSem = $student->sem;

        if ($currentSem == 1) {
            $nextSem = 2;
            $nextYear = $currentYear;
        } else {
            $nextSem = 1;
            $nextYear = $currentYear + 1;
        }

        // Pull the student’s programme and specialization
        $programme = $student->programme;
        $specialization = $student->specialization;

        // Query courses for upcoming semester
        $query = Course::where('year', $nextYear)
            ->where('sem',  $nextSem)
            ->where('programme',  $programme)
            ->where('specialization',  $specialization);

        // Courses recommended for the next semester (based on student's year, sem, programme, specialization)
        $suggested = $query->get();

        // Get full course data the student already selected
        $selected = $student->courses()->get(); // returns Course models

        $selectedCodes = $selected->pluck('course_code')->toArray();

        // 	All other courses not yet selected
        $all_courses = Course::whereNotIn('course_code', $selectedCodes)->get();

        return view('student.view-course', compact(
            'suggested',
            'selected',
            'selectedCodes',
            'all_courses',
            'nextYear',
            'nextSem',
            'programme',
            'specialization'
        ));
    }

    public function storePreferences(Request $request)
    {
        $user     = Auth::user();
        $student  = Student::where('st_email', $user->email)->firstOrFail();

        // Merge the two arrays (checkboxes + any extras)
        $codes = array_merge(
            $request->input('course_codes', []), // Checkboxes for suggested
            $request->input('extra_codes', []) // Multi-select or modal for other courses
        );

        // Clear old preferences
    $student->preferences()->delete();

    foreach ($codes as $code) {
        $course = Course::where('course_code', $code)->first();

        if ($course) {
            $student->preferences()->create([
                'course_code'   => $course->course_code,
                'course_title'  => $course->course_title,
                'credit_hrs'    => $course->credit_hrs,
                'action'        => 'add', // or any default value
            ]);
        }
    }

        return back()->with('success', 'Study plan updated!');
    }
}
