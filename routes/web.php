<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentPreferenceController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        // If the user is already logged in
        if (Auth::user()->role_id === 1) {
            // Send admins to their dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // send students to their dashboard
            return redirect()->route('student.dashboard');
        }
    }
    // otherwise send guests to login
    return redirect()->route('login');
})->middleware('auth')->name('dashboard');


// Route for CGPA Calculator
Route::get('cgpa-calculator', function () {
    return view('student.cgpa-calculator');
})->name('cgpa.calculator');


//Route for DATABASE
Route::middleware(['auth'])->group(function () {
    Route::get('student-dashboard', [StudentController::class, 'showDashboardForLoggedInUser'])->name('student.dashboard');
    Route::get('admin-dashboard', [AdminController::class, 'showDashboardForLoggedInAdmin'])->name('admin.dashboard');
    
});

Route::get('admin-courses', [AdminController::class, 'showCoursesList'])->name('admin.courses');

Route::get('student-courses', [StudentPreferenceController::class, 'showRecommendedCourses'])->name('student.courses');
Route::post('student-course/add', [StudentPreferenceController::class, 'storePreferences'])->name('student.preferences.store');

//Student update profile to student database
Route::middleware(['auth'])->group(function () {
    Route::get('/update-profile', [StudentController::class, 'editProfile'])->name('update.profile');
    Route::put('/student/update-profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
});

Route::get('/admin/course/edit/{course_code}', [CourseController::class, 'editCourse'])->name('admin.course.edit');
Route::post('/admin/course/update/{course_code}', [CourseController::class, 'updateCourse'])->name('admin.course.update');
Route::delete('admin-course/{course_code}', [CourseController::class, 'deleteCourse'])->name('admin.course.delete');

// Show the “New Course” form
Route::get('addcourse', [CourseController::class, 'addCourse'])
     ->middleware('auth')
     ->name('admin.course.add');

// Handle the form POST and store the course
Route::post('addcourse', [CourseController::class, 'storeCourse'])
     ->middleware('auth')
     ->name('admin.course.store');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('student/student-dashboard');
//     })->name('student.dashboard');

//     // Route for admin dashboard
//     Route::get('admin-dashboard', function () {
//         return view('admin/admin-dashboard');
//     })->name('admin.dashboard');
// });