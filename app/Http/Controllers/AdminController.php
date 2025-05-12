<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    

    //Display data from Admin Table to adminSSP-dashboard
    public function showDashboardForLoggedInAdmin()
    {
    // Get the currently authenticated user's email
    $email = Auth::user()->email;
    // Retrieve the admin by email only (no relations loaded)
    $admin = Admin::where('ad_email', $email)->firstOrFail();
    // Find the corresponding admin using the email with relationship
    // $student = Student::with('preferences', 'calculateCGPA')
    //             ->where('ad_email', $email)
    //             ->firstOrFail();
    return view('StudyPlanner.adminSSP-dashboard', compact('admin'));
    }
}
