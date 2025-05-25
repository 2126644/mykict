<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentPreference;


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

    return redirect()->route('admin.dashboard')->with('success', 'Course added successfully!');

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

    $hidden = session()->get('temp_hidden_courses', []);
    $removed = session()->get('permanently_removed_courses', []);
    $hideCodes = $removed; // sebab kita pakai course_code sebagai PK

    $query = Course::where('year', $student->year)
                ->where('sem', $student->sem);

    if (!empty($hidden)) {
        $query->whereNotIn('id', $hidden); // jika guna id untuk temporary hide
    }

    if (!empty($hideCodes)) {
        $query->whereNotIn('course_code', $hideCodes); // untuk permanently removed
    }

    $courses = $query->get();



    $courses = $query->get(); // Use paginate() if preferred

    return view('student.view-course', compact('courses'));
}

public function removeCourse($course_code)
{
    $user = Auth::user();
    $student = Student::where('st_email', $user->email)->first();
    $course = Course::where('course_code', $course_code)->firstOrFail();

    $existing = StudentPreference::where('matric_no', $student->matric_no)
        ->where('course_code', $course->course_code)
        ->first();

    if ($existing) {
    // Jika sudah disimpan ke database, hanya tandakan untuk delete dalam session
    $marked = session()->get('to_delete_preferences', []);
    $marked[] = $course->course_code;
    session(['to_delete_preferences' => array_unique($marked)]);
} else {
    // Kalau belum pernah save, sembunyikan sahaja dari view
    $hidden = session()->get('temp_hidden_courses', []);
    $hidden[] = $course->id;
    session(['temp_hidden_courses' => array_unique($hidden)]);
}


    return back()->with('success', 'Course removed.');
}



}

