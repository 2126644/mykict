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
}
