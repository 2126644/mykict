<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;

// Home page
// Route::get('/', function () {
//     // If the user is already logged in…
//     if (Auth::check()) {
//         // Send admins to their dashboard…
//         if (Auth::user()->role_id === 1) {
//             return redirect()->route('admin.dashboard');
//         }
//         // …and students to /todo
//         return redirect()->route('student.dashboard');
//     }
//     // Otherwise send guests to login
//     return redirect()->route('login');
// });

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role_id === 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }

    return redirect()->route('login');
})->middleware('auth')->name('dashboard');


// Route for CGPA Calculator
Route::get('cgpa-calculator', function () {
    return view('student.cgpa-calculator');
})->name('cgpa.calculator');

// Route for Edit Course
Route::get('edit-course', function () {
    return view('admin.edit-course');
})->name('edit.course');

//Route for DATABASE
Route::middleware(['auth'])->group(function () {
    Route::get('student-dashboard', [StudentController::class, 'showDashboardForLoggedInUser'])->name('student.dashboard');
    Route::get('admin-dashboard', [AdminController::class, 'showDashboardForLoggedInAdmin'])->name('admin.dashboard');
    
});

Route::get('admin-courses', [AdminController::class, 'showCoursesList'])->name('admin.courses');

Route::get('student-courses', [CourseController::class, 'showRecommendedCourses'])->name('student.courses');

Route::post('student-course/remove/{course_code}', [CourseController::class, 'removeCourse'])->name('student.course.remove');
Route::post('student-preferences', [StudentController::class, 'storePreferences'])->name('student.preferences.store');

//Student update profile to student database
Route::middleware(['auth'])->group(function () {
    Route::get('/update-profile', [StudentController::class, 'editProfile'])->name('update.profile');
    Route::put('/student/update-profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
});

//Admin add course store to course database
Route::post('addcourse', [CourseController::class, 'store'])->name('admin.addcourse');

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