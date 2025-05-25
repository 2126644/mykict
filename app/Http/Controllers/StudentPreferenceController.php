<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentPreference;

class StudentPreferenceController extends Controller
{
//     public function storePreferencer(Request $request)
// {
//     $courseCodes = $request->input('course_codes', []);
//     $courseTitles = $request->input('course_titles', []);
//     $creditHours = $request->input('credit_hrs', []);

//     $studentId = Auth::id(); // assuming you're using auth for student

//     for ($i = 0; $i < count($courseCodes); $i++) {
//         StudentPreference::create([
//             'student_id' => $studentId,
//             'course_code' => $courseCodes[$i],
//             'course_title' => $courseTitles[$i],
//             'credit_hrs' => $creditHours[$i],
//         ]);
//     }

//     return redirect()->back()->with('success', 'Course preferences saved successfully!');
// }
}
