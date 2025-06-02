<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentPreference;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    //Display data from Student Table to SSP-dashboard
    public function showDashboardForLoggedInUser()
    {
        $student = Auth::user()->student; // returns null or a Student model
        if (! $student) {
            abort(404);
        }

        if (!$student) {
            return redirect()->route('logout')->withErrors(['error' => 'Student profile not found!']);
        }

        //Display CGPA tracker from Student table
        $gpa = [];
        $cgpa = [];

        for ($i = 1; $i <= 8; $i++) {
            $gpa[] = $student->{'gpa_sem' . $i} ?? null;
            $cgpa[] = $student->{'cgpa_sem' . $i} ?? null;
        }

        $currentSem = $student->sem;
        $currentYear = $student->year;

        // Compute “next semester” logic
        if ($currentSem == 1) {
            $nextSem = 2;
            $nextYear = $currentYear;
        } else {
            $nextSem = 1;
            $nextYear = $currentYear + 1;
        }

        $preferenceCourseCodes = $student->preferences()
            ->where('action', 'add')
            ->pluck('course_code')
            ->unique()
            ->toArray();

        $upcomingSubjects = Course::whereIn('course_code', $preferenceCourseCodes)
            ->orderBy('year')->orderBy('sem')
            ->get();

        $totalSubjects = StudentPreference::where('matric_no', $student->matric_no)
            ->where('action', 'add')
            ->count();

        $totalCreditHours = StudentPreference::where('matric_no', $student->matric_no)
            ->where('action', 'add')
            ->sum('credit_hrs');

        return view('student.student-dashboard', compact(
            'student',
            'gpa',
            'cgpa',
            'nextSem',
            'nextYear',
            'upcomingSubjects',
            'totalSubjects',
            'totalCreditHours'
        ));
    }

    //SO FAR TAK JADI PAKAI SBB BUTTON TAK JALAN Show data from student preference table to cgpa calculator page
    public function showCgpaCalculator()
    {
    $user = Auth::user();

    $student = Student::where('user_id', $user->id)->first();

    if (! $student) {
        return redirect()->route('logout')->withErrors(['error' => 'Student profile not found!']);
    }

    $preferences = $student->preferences()->get(); // ✅ This will get all related preferences

    $preferenceCourseCodes = $preferences
        ->where('action', 'add')
        ->pluck('course_code')
        ->unique()
        ->toArray();

    $upcomingSubjects = Course::whereIn('course_code', $preferenceCourseCodes)
        ->orderBy('year')
        ->orderBy('sem')
        ->get();

    $totalCreditHours = StudentPreference::where('matric_no', $student->matric_no)
            ->where('action', 'add')
            ->sum('credit_hrs');

    return view('student.cgpa-calculator', compact('student', 'preferences', 'upcomingSubjects', 'totalCreditHours'));
    }



    //Edit student details
    public function editProfile()
    {
        $student = Auth::user()->student; // returns null or a Student model
        if (! $student) {
            abort(404);
        }

        // Fetch distinct “specializations” from the courses table
        $specializations = Course::select('specialization')
            ->distinct()
            ->orderBy('specialization')
            ->pluck('specialization');

        $programmes = Course::select('programme')
            ->distinct()
            ->orderBy('programme')
            ->pluck('programme');

        return view('student.update-profile', compact('student', 'specializations', 'programmes'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::user()->student; // returns null or a Student model
        if (! $student) {
            abort(404);
        }

        // Validate inputs
        $validated = $request->validate([
            // allow letters, spaces, dots, apostrophes, hyphens
            'st_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z .\'-]+$/'],

            'programme' => ['required', 'string', Rule::in(Course::distinct()->pluck('programme')->toArray())],
            'specialization' => ['nullable', 'string', Rule::in(Course::distinct()->pluck('specialization')->toArray())],
            'year' => ['required', 'integer', 'min:1', 'max:4'],
            'sem' => ['required', 'integer', 'min:1', 'max:8'],

            // Between 0 and 4.00, up to two decimal places:
            'current_cgpa' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'target_cgpa' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],

            'gpa_sem1' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem1' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem2' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem2' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem3' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem3' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem4' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem4' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem5' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem5' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem6' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem6' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem7' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem7' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'gpa_sem8' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
            'cgpa_sem8' => ['nullable', 'numeric', 'between:0,4.00', 'regex:/^\d(\.\d{1,2})?$/'],
        ]);


        // Mass‐assign everything at once
        // If validation keys exactly match database column names, and listed in Student::$fillable
        $student->update($validated);

        return redirect()->route('student.dashboard')->with('success', 'Profile updated successfully.');
    }

    /**
     * Return a JSON list of distinct specializations for a given programme.
     * Example URL: /ajax/specializations/BIT
     */
    public function getSpecializations(string $programme)
    {
        // Basic sanitation: make sure programme is a valid string
        $programme = trim($programme);

        // Or, without the scope:
        $specializations = Course::where('programme', $programme)
            ->distinct()
            ->pluck('specialization');

        return response()->json($specializations);
    }
}

/**
 * Update the student profile in the database.
 */

        // public function update(Request $request, $matric_no)
        // {
        // $student = Student::where('matric_no', $matric_no)->firstOrFail();

        // $student->update([
        // 'st_name' => $request->input('st_name'),
        // 'matric_no' => $request->input('matric_no'),
        // 'major' => $request->input('major'),
        // 'specialization' => $request->input('specialization'),
        // 'year' => $request->input('year'),
        // 'sem' => $request->input('sem'),
        // 'current_cgpa' => $request->input('current_cgpa'),
        // 'target_cgpa' => $request->input('target_cgpa'),
        // 'gpa_sem1' => $request->input('gpa_sem1'),
        // 'cgpa_sem1' => $request->input('cgpa_sem1'),
        // 'gpa_sem2' => $request->input('gpa_sem2'),
        // 'cgpa_sem2' => $request->input('cgpa_sem2'),
        // 'gpa_sem3' => $request->input('gpa_sem3'),
        // 'cgpa_sem3' => $request->input('cgpa_sem3'),
        // 'gpa_sem4' => $request->input('gpa_sem4'),
        // 'cgpa_sem4' => $request->input('cgpa_sem4'),
        // 'gpa_sem5' => $request->input('gpa_sem5'),
        // 'cgpa_sem5' => $request->input('cgpa_sem5'),
        // 'gpa_sem6' => $request->input('gpa_sem6'),
        // 'cgpa_sem6' => $request->input('cgpa_sem6'),
        // 'gpa_sem7' => $request->input('gpa_sem7'),
        // 'cgpa_sem7' => $request->input('cgpa_sem7'),
        // 'gpa_sem8' => $request->input('gpa_sem8'),
        // 'cgpa_sem8' => $request->input('cgpa_sem8'),
        // ]);

        // return redirect()->route('students.edit', $matric_no)
        //                 ->with('success', 'Profile updated successfully.');
        // }

    // public function update(Request $request, $matric_no)
    // {
    // $student = Student::where('matric_no', $matric_no)->firstOrFail();

    // $student->update($request->only([
    //     'st_name',
    //     'matric_no',
    //     'major',
    //     'specialization',
    //     'year',
    //     'sem',
    //     'current_cgpa',
    //     'target_cgpa',
    //     'gpa_sem1', 'cgpa_sem1',
    //     'gpa_sem2', 'cgpa_sem2',
    //     'gpa_sem3', 'cgpa_sem3',
    //     'gpa_sem4', 'cgpa_sem4',
    //     'gpa_sem5', 'cgpa_sem5',
    //     'gpa_sem6', 'cgpa_sem6',
    //     'gpa_sem7', 'cgpa_sem7',
    //     'gpa_sem8', 'cgpa_sem8',
    // ]));

    // return redirect()->back()->with('success', 'Profile updated successfully!');
    // // return redirect()->route('SSP.dashboard')->with('success', 'Profile updated successfully!');
    // // return redirect()->route('students.update')->with('success', 'Profile updated successfully!');
    // }
    // public function update(Request $request, $matric_no)
    // {
    //     $request->validate([
    //         'st_name' => 'required|string|max:255',
    //         'st_email' => 'nullable|email|max:255',
    //         'year' => 'nullable|integer',
    //         'sem' => 'nullable|integer',
    //         'major' => 'nullable|string',
    //         'specialization' => 'nullable|string',
    //         'current_cgpa' => 'nullable|numeric',
    //         'target_cgpa' => 'nullable|numeric',
    //         // You can also validate GPA/CGPA fields if needed
    //     ]);

    //     $student = Student::where('matric_no', $matric_no)->firstOrFail();

    //     $student->update($request->only([
    //         'st_name',
    //         'st_email',
    //         'year',
    //         'sem',
    //         'major',
    //         'specialization',
    //         'current_cgpa',
    //         'target_cgpa',
    //         'gpa_sem1', 'cgpa_sem1',
    //         'gpa_sem2', 'cgpa_sem2',
    //         'gpa_sem3', 'cgpa_sem3',
    //         'gpa_sem4', 'cgpa_sem4',
    //         'gpa_sem5', 'cgpa_sem5',
    //         'gpa_sem6', 'cgpa_sem6',
    //         'gpa_sem7', 'cgpa_sem7',
    //         'gpa_sem8', 'cgpa_sem8',
    //     ]));

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    //     // return redirect()->route('SSP.dashboard', ['matric_no' => $student->matric_no])
    //     //              ->with('success', 'Profile updated successfully.');
    // }
