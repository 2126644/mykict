<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Course; 

class AdminController extends Controller
{
    //Display data from Admin Table to adminSSP-dashboard
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
    $years = Course::select('year')->distinct()->pluck('year'); // if exists
    
    // Build course query with filters
    $query = Course::query();

    if ($request->filled('department')) {
        $query->where('department', $request->department);
    }
    if ($request->filled('specialization')) {
        $query->where('specialization', $request->specialization);
    }
        if ($request->filled('year')) {
        $query->where('year', $request->year);
    }
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }


    $courses = $query->get();

    //  $total_course = DB::table('student_preferences')
    //     ->where('course_code', $course_code)
    //     ->where('action', 'add')
    //     ->count();

    // Return the view with all data
    return view('StudyPlanner.adminSSP-dashboard', compact(
        'admin',
        'departments',
        'specializations',
        'years',
        'categories',
        'courses'
    ));
    }
}
