<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Student;


class CourseController extends Controller
{
    public function store(Request $request)
    {
    $validated = $request->validate([
        'course_code' => 'required|string|max:255',
        'course_title' => 'required|string|max:255',
        'credit_hrs' => 'required|int',
        'department' => 'required|string',
        'pre_requisites' => 'nullable|string',
        'year' => 'required|int',
        'sem' => 'required|int',
        'specialization' => 'nullable|string',
        'category' => 'nullable|string',
    ]);

    Course::create($validated);

    return redirect()->route('adminSSP.dashboard')->with('success', 'Course added successfully!');

    }

    public function showRecommendedCourses(Request $request)
{
    $user = Auth::user();

    // Get student info using email
    $student = Student::where('st_email', $user->email)->firstOrFail();

    // Start course query with year and sem filters
    $query = Course::where('year', $student->year)
                   ->where('sem', $student->sem);

    // Apply optional search filters
    if ($request->filled('course_code')) {
        $query->where('course_code', 'like', '%' . $request->course_code . '%');
    }

    if ($request->filled('course_title')) {
        $query->where('course_title', 'like', '%' . $request->course_title . '%');
    }

    $courses = $query->get(); // Use paginate() if preferred

    return view('StudyPlanner.view-course', compact('courses'));
}

}

