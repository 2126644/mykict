<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Show the student profile update form.
     */
    // public function edit($matric_no)
    // {
    //     $user = Auth::user();
    //     // $student = Student::where('st_email', $user->email)->first();
    //     $student = Student::where('matric_no', $matric_no)->firstOrFail();
    //     // return view('SSP-dashboard', compact('student'));
    //     return view('StudyPlanner.update-profile', compact('student'));
    // }


    //Display data from Student Table to SSP-dashboard
    public function showDashboardForLoggedInUser()
    {
    // Get the currently authenticated user's email
    $email = Auth::user()->email;
    // Retrieve the student by email only (no relations loaded)
    $student = Student::where('st_email', $email)->firstOrFail();
    // Find the corresponding student using the email with relationship
    // $student = Student::with('preferences', 'calculateCGPA')
    //             ->where('st_email', $email)
    //             ->firstOrFail();
    return view('StudyPlanner.SSP-dashboard', compact('student'));
    }

    public function edit($matric_no)
    {
        $student = Student::where('matric_no', $matric_no)->firstOrFail();

        return view('StudyPlanner.update-profile', compact('student'));
    }

        /**
         * Update the student profile in the database.
         */

        public function update(Request $request, $matric_no)
        {
        $student = Student::where('matric_no', $matric_no)->firstOrFail();

        $student->update([
        'st_name' => $request->input('st_name'),
        'matric_no' => $request->input('matric_no'),
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

        return redirect()->route('students.edit', $matric_no)
                        ->with('success', 'Profile updated successfully.');
        }

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
}
