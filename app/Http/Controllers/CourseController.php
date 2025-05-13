<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

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

public function stats($course_code)
{
    $maxPerSection = 30;

    $total_students = DB::table('student_preferences')
        ->where('course_code', $course_code)
        ->where('action', 'add')
        ->count();

    $sections = ceil($total_students / $maxPerSection);

    return view('adminSSP.dashboard', [
        'course_code' => $course_code,
        'total_students' => $total_students,
        'sections' => $sections,
    ]);
}
}
