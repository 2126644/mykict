<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //Display data from Admin Table to admin-dashboard
    public function showDashboardForLoggedInAdmin(Request $request)
    {
        // Get the currently authenticated user's email
        $email = Auth::user()->email;
        // Retrieve the admin by email only (no relations loaded)
        $admin = Admin::where('ad_email', $email)->firstOrFail();
        // Find the corresponding admin using the email with relationship
        // $student = Student::with('preferences', 'calculateCGPA')
        //             ->where('ad_email', $email)
        //             ->firstOrFail();

        // Get filter options from database
        $departments = Course::select('department')->distinct()->pluck('department');
        $specializations = Course::select('specialization')->distinct()->pluck('specialization');
        $categories = Course::select('category')->distinct()->pluck('category');
        $years = Course::select('year')->distinct()->pluck('year'); 

        // Start base query from courses table
        $query = DB::table('courses as c')
            ->leftJoin('student_preferences as sp', function ($join) {
                $join->on('c.course_code', '=', 'sp.course_code')
                    ->where('sp.action', '=', 'add');
            })
            ->select(
                'c.course_code',
                'c.course_title',
                'c.department',
                'c.specialization',
                'c.year',
                'c.category',
                DB::raw('COUNT(DISTINCT sp.matric_no) as total_students')
            )
            ->groupBy('c.course_code', 'c.course_title', 'c.department', 'c.specialization', 'c.year', 'c.category');

        // Apply filters
        if ($request->filled('department')) {
            $query->where('c.department', $request->department);
        }
        if ($request->filled('specialization')) {
            $query->where('c.specialization', $request->specialization);
        }
        if ($request->filled('year')) {
            $query->where('c.year', $request->year);
        }
        if ($request->filled('category')) {
            $query->where('c.category', $request->category);
        }

        $courses = $query->orderByDesc('total_students')->get();


        // Return the view with all data
        return view('admin.admin-dashboard', compact(
            'admin',
            'departments',
            'specializations',
            'years',
            'categories',
            'courses'
        ));
    }

    public function showCoursesList(Request $request)
{
    // Whitelist/validate the search input
    $validated = $request->validate([
        // Letters (A-Z, a-z), Numbers (0-9), Spaces
        'course_code' => ['nullable', 'string', 'max:10', 'regex:/^[A-Z0-9 ]+$/i'],
        // Letters (A-Z, a-z), Numbers (0-9), Spaces , Dots ., Hyphens -, Apostrophes ', Parentheses ()
        'course_title' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9 .\-\'()]+$/'],
    ]);

    $query = Course::query();

    if (!empty($validated['course_code'])) {
        $query->where('course_code', 'like', '%' . $validated['course_code'] . '%');
    }

    if (!empty($validated['course_title'])) {
        $query->where('course_title', 'like', '%' . $validated['course_title'] . '%');
    }

    $courses = $query->get();

    // Get filter options from database
        $departments = Course::select('department')->distinct()->pluck('department');
        $specializations = Course::select('specialization')->distinct()->pluck('specialization');
        $categories = Course::select('category')->distinct()->pluck('category');
        $years = Course::select('year')->distinct()->pluck('year'); 

     return view('admin.list-course', compact(
        'courses',
        'departments',
        'specializations',
        'years',
        'categories'
    ));
}

}
