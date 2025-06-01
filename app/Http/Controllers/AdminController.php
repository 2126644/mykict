<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use Carbon\Carbon;

class AdminController extends Controller
{
    //Display data from Admin Table to admin-dashboard
    public function showDashboardForLoggedInAdmin(Request $request)
    {
        // Get the currently authenticated user's email
        $email = Auth::user()->email;
        // Retrieve the admin by email only (no relations loaded)
        $admin = Admin::where('ad_email', $email)->firstOrFail();

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

        for ($year = 1; $year <= 4; $year++) {
            for ($sem = 1; $sem <= 2; $sem++) {
                $enrollments[]  = Student::where('year', $year)
                    ->where('sem', $sem)
                    ->count();
                $enrollLabels[] = "Y{$year}S{$sem}";
            }
        }

        // 4) Course Popularity (top 10)
        $popular = DB::table('student_preferences')
            ->select('course_code', DB::raw('COUNT(*) as total'))
            ->groupBy('course_code')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $popularLabels = $popular->pluck('course_code')->toArray();
        $popularCounts = $popular->pluck('total')->toArray();

        // 4) Gender by Year/Semester
        $genderBySemMale   = [];
        $genderBySemFemale = [];

        foreach ($enrollLabels as $label) {
            list($y, $s) = sscanf($label, 'Y%dS%d');
            $genderBySemMale[] = Student::where('year', $y)
                ->where('sem',  $s)
                ->whereRaw("CAST(RIGHT(matric_no,1) AS UNSIGNED) % 2 = 1")
                ->count();
            $genderBySemFemale[] = Student::where('year', $y)
                ->where('sem',  $s)
                ->whereRaw("CAST(RIGHT(matric_no,1) AS UNSIGNED) % 2 = 0")
                ->count();
        }


        // 5) Monthly New Student Sign-Ups (last 12 months)
        $period = collect();
        for ($i = 11; $i >= 0; $i--) {
            $period->push(Carbon::now()->subMonths($i)->format('Y-m'));
        }

        $rawSignups = Student::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $signupLabels = $period->all();
        $signupCounts = array_map(fn($m) => $rawSignups[$m] ?? 0, $signupLabels);


        $capacity = 30;

        // 6) Departmental Demand (needed sections per department)
        $courseCounts = DB::table('student_preferences as sp')
            ->join('courses as c', 'sp.course_code', '=', 'c.course_code')
            ->select('c.department', 'sp.course_code', DB::raw('COUNT(*) as total'))
            ->groupBy('sp.course_code', 'c.department')
            ->get();

        // sum ceil(total / capacity) per department
        $deptNeeded = [];
        foreach ($courseCounts as $row) {
            $needed = (int) ceil($row->total / $capacity);
            $deptNeeded[$row->department] = ($deptNeeded[$row->department] ?? 0) + $needed;
        }

        // build the ApexCharts-friendly series array
        $treemapData = [];
        foreach ($deptNeeded as $dept => $sections) {
            $treemapData[] = ['x' => $dept, 'y' => $sections];
        }

        // 7) Total Students per Specialization
        $specTotalsRaw = DB::table('student_preferences as sp')
            ->join('courses as c', 'sp.course_code', '=', 'c.course_code')
            ->select('c.specialization', DB::raw('COUNT(DISTINCT sp.matric_no) as total'))
            ->groupBy('c.specialization')
            ->pluck('total', 'specialization')
            ->toArray();

        $specLabels = array_keys($specTotalsRaw);
        $specCounts = array_values($specTotalsRaw);

        // Return the view with all data
        return view('admin.admin-dashboard', compact(
            'admin',
            'courses',
            'enrollments',
            'enrollLabels',
            'year',
            'sem',
            'popularLabels',
            'popularCounts',
            'genderBySemMale',
            'genderBySemFemale',
            'signupLabels',
            'signupCounts',
            'treemapData',
            'specLabels', 
            'specCounts'
        ));
    }

    public function showCoursesList(Request $request)
    {
        // 1) Validate only the search inputs (course_code & course_title)
        $validated = $request->validate([
            'course_code'  => ['nullable', 'string', 'max:10', 'regex:/^[A-Z0-9 ]+$/i'],
            'course_title' => ['nullable', 'string', 'max:255', 'regex:/^[A-Za-z0-9 .\-\'()]+$/']
        ]);

        // 2) Start the base query
        $query = Course::query();

        // 3) Apply search by course_code if present
        if (!empty($validated['course_code'])) {
            $query->where('course_code', 'like', '%' . $validated['course_code'] . '%');
        }

        // 4) Apply search by course_title if present
        if (!empty($validated['course_title'])) {
            $query->where('course_title', 'like', '%' . $validated['course_title'] . '%');
        }

        // 5) Apply the year filter if provided
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // 6) Apply the department filter if provided
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // 7) Apply the category filter if provided
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 8) Apply the specialization filter if provided
        if ($request->filled('specialization')) {
            $query->where('specialization', $request->specialization);
        }

        // 9) Apply the programme filter if provided
        if ($request->filled('programme')) {
            $query->where('programme', $request->programme);
        }

        // 10) Finally, retrieve the filtered courses
        // Add a “withCount” to count how many StudentPreference rows (action='add') each course has
        $courses = $query
            ->withCount([
                // “studentPreferences” relationship, but only count those where action = 'add'
                'preferences as total_students' => function($subQuery) {
                    $subQuery->where('action', 'add');
                }
            ])
            ->orderBy('course_code')
            ->get();

        // 11) Fetch distinct dropdown values for each filter
        $departments     = Course::select('department')->distinct()->pluck('department');
        $specializations = Course::select('specialization')->distinct()->pluck('specialization');
        $categories      = Course::select('category')->distinct()->pluck('category');
        $years           = Course::select('year')->distinct()->pluck('year');
        $programmes      = Course::select('programme')->distinct()->pluck('programme');

        // 12) Return the view, passing:
        //    - $courses
        //    - the distinct lists for each dropdown
        //    - “sticky” filter values so the form can mark <option selected> correctly
        //    - the search terms so the search inputs stay populated
        return view('admin.list-course', [
            'courses'            => $courses,
            'departments'        => $departments,
            'specializations'    => $specializations,
            'categories'         => $categories,
            'years'              => $years,
            'programmes'         => $programmes,

            // Sticky filter values:
            'filterYear'           => $request->year,
            'filterDepartment'     => $request->department,
            'filterCategory'       => $request->category,
            'filterSpecialization' => $request->specialization,
            'filterProgramme'      => $request->programme,

            // Search inputs (so the text fields remain populated):
            'searchCode'           => $request->course_code,
            'searchTitle'          => $request->course_title,
        ]);
    }
}
