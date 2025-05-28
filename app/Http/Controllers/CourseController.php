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
    /**
     * Show the “create a new course” form.
     */
    public function addCourse()
    {
        return view('admin.add-course');
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:255|regex:/^[A-Z0-9]+$/i',
            'course_title' => 'required|string|max:255|regex:/^[A-Za-z0-9 .\-\'()]+$/',
            'credit_hrs' => 'required|int',
            'department' => 'required|string',
            'pre_requisites' => 'nullable|string|regex:/^[A-Z0-9]+$/i',
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
            'course_code' => 'required|string|max:255|regex:/^[A-Z0-9]+$/i',
            'course_title' => 'required|string|max:255|regex:/^[A-Za-z0-9 .\-\'()]+$/',
            'credit_hrs' => 'required|integer|min:1',
            'pre_requisites' => 'nullable|string|regex:/^[A-Z0-9]+$/i',
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

    /* This method is used to fetch the course's current data and 
    send it to the Blade view for editing **/
    public function deleteCourse(string $courseCode)
    {
        // Find the course by its code
        $course = Course::where('course_code', $courseCode)->firstOrFail();

        $course->delete();

        // Pass the course data to the Blade view
        return back()->with('success', "Course {$courseCode} deleted successfully.");
    }

    public function bulkDelete(Request $request)
{
    $codes = $request->input('course_codes', []);
    if (!empty($codes)) {
        Course::whereIn('course_code', $codes)->delete();
        return redirect()->back()->with('success', 'Selected courses deleted successfully!');
    }
    return redirect()->back()->with('error', 'No courses selected.');
}

}
