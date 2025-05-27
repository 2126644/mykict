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

    /* This method is used to fetch the course's current data and 
    send it to the Blade view for editing **/
    public function editCourse($courseCode)
    {
        // Find the course by its ID
        $course = Course::where('course_code', $courseCode)->firstOrFail();

        // Pass the course data to the Blade view
        return view('admin.edit-course', compact('course'));
    }


    /* this method is called after admin submits the form, 
    validating and updating the course **/
    public function updateCourse(Request $request, $courseCode)
    {
        // Find the course
        $course = Course::where('course_code', $courseCode)->firstOrFail();

        // Validate input
        $request->validate([
            'course_code' => 'required|string|max:255',
            'course_title' => 'required|string|max:255',
            'credit_hrs' => 'required|integer|min:1',
            'pre_requisites' => 'nullable|string',
            'year' => 'required|integer|min:1|max:4',
            'sem' => 'required|integer|min:1|max:8',
            'category' => 'nullable|string',
            'department' => 'nullable|string',
            'specialization' => 'nullable|string',
        ]);

        // Update course fields
        $course->update($request->all());

        return redirect()->route('admin.courses')->with('success', 'Course updated successfully.');
    }

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

        // Query courses for upcoming semester
        $query = Course::where('year', $nextYear)->where('sem', $nextSem);

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

        if (!empty($hidden)) {
            $query->whereNotIn('id', $hidden); // jika guna id untuk temporary hide
        }

        if (!empty($hideCodes)) {
            $query->whereNotIn('course_code', $hideCodes); // untuk permanently removed
        }

        $courses = $query->get();

        return view('student.view-course', compact('courses', 'nextSem', 'nextYear'));
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
