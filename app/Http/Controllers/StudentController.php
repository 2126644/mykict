<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentPreference;
use App\Models\Student;

class StudentController extends Controller
{
    //Display data from Student Table to SSP-dashboard
    public function showDashboardForLoggedInUser()
    {
        // Get the currently authenticated user's email
        $email = Auth::user()->email;
        // Retrieve the student by email only (no relations loaded)
        $student = Student::where('st_email', $email)->firstOrFail();

        //Display CGPA tracker from Student table
        $gpa = [];
        $cgpa = [];

        for ($i = 1; $i <= 8; $i++) {
            $gpa[] = $student->{'gpa_sem' . $i} ?? null;
            $cgpa[] = $student->{'cgpa_sem' . $i} ?? null;
        }

        return view('student.student-dashboard', compact('student', 'gpa', 'cgpa'));
    }

    //Edit student details
    public function editProfile()
    {
        $user = Auth::user();

        $student = Student::where('st_email', $user->email)->firstOrFail();

        return view('student.update-profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // // Get student record based on authenticated user's email
        $student = Student::where('st_email', $user->email)->firstOrFail();

        // Validate inputs (optional but recommended)
        $request->validate([
            'st_name' => 'required|string|max:255',
            'major' => 'nullable|string',
            'specialization' => 'nullable|string',
            'year' => 'required|integer|min:1|max:4',
            'sem' => 'required|integer|min:1|max:8',
            'current_cgpa' => 'nullable|numeric|between:0,4.00',
            'target_cgpa' => 'nullable|numeric|between:0,4.00',
        ]);

        // Update student fields
        $student->update([
            'st_name' => $request->input('st_name'),
            'major' => $request->input('major'),
            'specialization' => $request->input('specialization'),
            'year' => $request->input('year'),
            'sem' => $request->input('sem'),
            'current_cgpa' => $request->input('current_cgpa'),
            'target_cgpa' => $request->input('target_cgpa'),
            'gpa_sem1' => $request->input('gpa_sem1'),
            'cgpa_sem1' => $request->input('cgpa_sem1'),
            'gpa_sem2' => $request->input('gpa_sem2'),
            'cgpa_sem2' => $request->input('cgpa_sem2'),
            'gpa_sem3' => $request->input('gpa_sem3'),
            'cgpa_sem3' => $request->input('cgpa_sem3'),
            'gpa_sem4' => $request->input('gpa_sem4'),
            'cgpa_sem4' => $request->input('cgpa_sem4'),
            'gpa_sem5' => $request->input('gpa_sem5'),
            'cgpa_sem5' => $request->input('cgpa_sem5'),
            'gpa_sem6' => $request->input('gpa_sem6'),
            'cgpa_sem6' => $request->input('cgpa_sem6'),
            'gpa_sem7' => $request->input('gpa_sem7'),
            'cgpa_sem7' => $request->input('cgpa_sem7'),
            'gpa_sem8' => $request->input('gpa_sem8'),
            'cgpa_sem8' => $request->input('cgpa_sem8'),
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function storePreferences(Request $request)
    {
        $student = Student::where('st_email', Auth::user()->email)->first();

        $codes = $request->input('course_codes', []);

        if (empty($codes)) {
            return back()->with('error', 'No courses selected.');
        }

        // Simpan semua course yang pelajar masih mahu
        foreach ($codes as $course_code) {
            StudentPreference::updateOrCreate([
                'matric_no' => $student->matric_no,
                'course_code' => $course_code,
            ], ['preferred' => true]);
        }

        $toDelete = session()->get('to_delete_preferences', []);
        // Padam course yang pelajar dah pernah simpan, tapi sekarang buang dari view
        foreach ($toDelete as $code) {
            StudentPreference::where('matric_no', $student->matric_no)
                ->where('course_code', $code)
                ->delete();
        }

        // Tambah ke session supaya kekal tersembunyi lepas save
$permanentlyRemoved = session()->get('permanently_removed_courses', []);
$permanentlyRemoved = array_merge($permanentlyRemoved, $toDelete);
session(['permanently_removed_courses' => array_unique($permanentlyRemoved)]);


        return back()->with('success', 'Courses saved successfully.');
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
