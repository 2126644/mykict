<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CGPACalculatorController extends Controller
{
    // Function to display the initial form
    public function index()
    {
        return view('cgpa-calculator');
    }

    // Function to calculate GPA, CGPA, and forecast
    public function calculate(Request $request)
    {
        $courses = $request->input('courses');
        $total_credits = 0;
        $total_points = 0;
        $results = [];

        // Grade point mapping
        $grade_points = [
            'A' => 4.0,
            'A-' => 3.67,
            'B+' => 3.33,
            'B' => 3.0,
            'B-' => 2.67,
            'C+' => 2.33,
            'C' => 2.00,
            'D' => 1.67,
            'D-' => 1.33,
            'E' => 1.0,
            'F' => 0.0,
        ];

        // Calculate the total points and total credits
        foreach ($courses as $course) {
            $grade = strtoupper($course['grade']);
            $credit_hours = $course['credit_hours'];
            $points = $grade_points[$grade] * $credit_hours;
            $total_credits += $credit_hours;
            $total_points += $points;

            $results[] = [
                'course_name' => $course['course_name'],
                'grade' => $grade,
                'credit_hours' => $credit_hours,
                'points' => $points,
            ];
        }

        // Calculate GPA and CGPA
        $gpa = $total_points / $total_credits;
        $cgpa = $total_points / $total_credits; // CGPA calculation logic can be modified if cumulative CGPA data is available

        // Forecasting for classification
        $forecast = $this->forecast($cgpa);

        return view('cgpa_calculator', compact('results', 'gpa', 'cgpa', 'forecast'));
    }

    // Forecasting feature to determine the GPA required for classifications
    private function forecast($cgpa)
    {
        $target_cgpas = [
            'First Class' => 3.5,
            'Second Upper Class' => 2.8,
            'Second Lower Class' => 2.0,
            'Third Class' => 1.5,
        ];

        $forecast = [];
        foreach ($target_cgpas as $classification => $target_cgpa) {
            $forecast[$classification] = [
                'target_cgpa' => $target_cgpa,
                'achievable' => $cgpa >= $target_cgpa ? 'Yes' : 'No',
            ];
        }

        return $forecast;
    }
}
