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
        $user = Auth::user();

        // Get student info using email
        $student = Student::where('st_email', $user->email)->firstOrFail();

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

        // Pull the student’s specialization
        $spec = $student->specialization;

        // Query courses for upcoming semester
        $query = Course::where('year', $nextYear)
            ->where('sem',  $nextSem);

        // Only filter by specialization if present
        if ($spec) {
            $query->where('specialization', $spec);
        }

        // Next sem/year, dept, spec
        $suggested = $query->get();

        // Get all course_codes the student already has
        // Already in pivot
        $selected = $student
        ->courses()
        ->select('courses.course_code')    // disambiguate here
        ->pluck('course_code')
        ->toArray();

        // All other courses for the “extra” selector/ not in $selected
        $all_courses = Course::whereNotIn('course_code', $selected)->get();

        return view('student.view-course', compact(
            'suggested',
            'selected',
            'all_courses',
            'nextSem',
            'nextYear'
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

        // Validate that every code actually exists
        $request->validate([
            'course_codes.*' => 'exists:courses,course_code',
            'extra_codes.*'  => 'exists:courses,course_code',
        ]);

        // Add any codes not yet in the pivot table and remove any codes that were unchecked
        $student->courses()->sync($codes);

        return back()->with('success', 'Study plan updated!');
    }
}
