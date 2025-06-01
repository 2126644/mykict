@extends('layouts.master')

@section('content')

    <style>
    body {
        background-color: #f4f8fb;
    }
    .card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
    }
    .card-body h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
    }
    .card-body h6 {
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    .page-title {
        font-size: 2rem;
        font-weight: bold;
        color: #2980b9;
    }
    .btn-info {
        background-color: #5dade2;
        border-color: #5dade2;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 500;
    }
    .btn-info:hover {
        background-color: #3498db;
        border-color: #3498db;
    }
    .card-title {
        font-weight: 600;
        color: #2980b9;
    }
    .card-header p {
        color: #7f8c8d;
        margin-top: 5px;
        font-size: 0.95rem;
    }
    </style>


    <div class="container mt-5">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Student Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.courses') }}">View Suggested Courses</a></li>
                        <li class="breadcrumb-item active">CGPA Calculator</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>




        <div class="text-center mb-4">
            <h1 class="text-primary">Smart CGPA Calculator & Forecaster</h1>
            <p class="text-muted">Plan your academic success with ease! Calculate your GPA, forecast CGPA changes, and
                explore various scenarios.</p>
        </div>




        <form id="cgpaForm" class="shadow p-4 rounded bg-light">
            <!-- Current CGPA Details -->
            <h4 class="text-secondary mb-4">Current CGPA Details</h4>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="currentCgpa" class="form-label">Current CGPA</label>
                        <input type="number" class="form-control" id="currentCgpa" placeholder="e.g., 3.50" step="0.01"
                            min="0" max="4.00">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="totalCredits" class="form-label">Total Credit Hours Completed</label>
                        <input type="number" class="form-control" id="totalCredits" placeholder="e.g., 90" min="0">
                    </div>
                </div>
            </div>




            <!-- Target CGPA Input -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="targetCgpa" class="form-label">Target CGPA</label>
                    <input type="number" class="form-control" id="targetCgpa" placeholder="e.g., 3.75" step="0.01"
                        min="0" max="4.00">
                </div>
            </div>




            <!-- New Semester Courses -->
            <h4 class="text-secondary mb-4">New Semester Courses</h4>
            <div id="coursesContainer">
                <div class="row mb-3 course-entry">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Course Name" name="courseName[]">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" placeholder="Credit Hours" name="creditHours[]"
                            min="1">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="grade[]">
                            <option value="" selected disabled>Target Grade</option>
                            <option value="4.00">A (4.00)</option>
                            <option value="3.67">A- (3.67)</option>
                            <option value="3.33">B+ (3.33)</option>
                            <option value="3.00">B (3.00)</option>
                            <option value="2.67">B- (2.67)</option>
                            <option value="2.33">C+ (2.33)</option>
                            <option value="2.00">C (2.00)</option>
                            <option value="1.67">C- (1.67)</option>
                            <option value="1.33">D+ (1.33)</option>
                            <option value="1.00">D (1.00)</option>
                            <option value="0.00">F (0.00)</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm mb-4" id="addCourse">+ Add Another Course</button>




            <!-- Calculate Button -->
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-lg" id="calculateGpa">Calculate GPA/CGPA</button>
            </div>
        </form>




        <!-- Results -->
        <div class="mt-5">
            <h4 class="text-secondary">Results</h4>
            <div class="alert alert-info text-center" id="result" style="display: none;">
                <p class="mb-2"><strong>Semester GPA:</strong> <span id="semesterGpa" class="text-success"></span></p>
                <p class="mb-2"><strong>Updated CGPA:</strong> <span id="updatedCgpa" class="text-success"></span></p>
                <p><strong>Required GPA to Reach Target:</strong> <span id="requiredGpa" class="text-danger"></span></p>
            </div>




            <!-- Forecasting Section -->
            <div id="forecastSection" class="mt-5">
                <h4 class="text-secondary">Forecasting Scenarios</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Reach 3.50 (Min First Class):</strong> <span id="reachMinFirstClass"></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Reach 4.00 (Max First Class):</strong> <span id="reachMaxFirstClass"></span>
                    </li>
                    <li class="list-group-item">
                        <strong>Reach Target CGPA:</strong> <span id="reachTargetCgpa"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script async type='module' src='https://interfaces.zapier.com/assets/web-components/zapier-interfaces/zapier-interfaces.esm.js'></script>
    <zapier-interfaces-chatbot-embed is-popup='true' chatbot-id='cmb8x30m4002qwowpp0bbi4k2'></zapier-interfaces-chatbot-embed>


    <script>
        document.getElementById('addCourse').addEventListener('click', function() {
            const courseContainer = document.getElementById('coursesContainer');
            const courseEntry = `
            <div class="row mb-3 course-entry">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Course Name" name="courseName[]">
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="Credit Hours" name="creditHours[]" min="1">
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="grade[]">
                        <option value="" selected disabled>Grade</option>
                        <option value="4.00">A (4.00)</option>
                        <option value="3.67">A- (3.67)</option>
                        <option value="3.33">B+ (3.33)</option>
                        <option value="3.00">B (3.00)</option>
                        <option value="2.67">B- (2.67)</option>
                        <option value="2.33">C+ (2.33)</option>
                        <option value="2.00">C (2.00)</option>
                        <option value="1.67">C- (1.67)</option>
                        <option value="1.33">D+ (1.33)</option>
                        <option value="1.00">D (1.00)</option>
                        <option value="0.00">F (0.00)</option>
                    </select>
                </div>
            </div>
        `;
            courseContainer.insertAdjacentHTML('beforeend', courseEntry);
        });




        document.getElementById('calculateGpa').addEventListener('click', function() {
            // Fetch user inputs and ensure default values are set
            const currentCgpa = parseFloat(document.getElementById('currentCgpa').value) || 0;
            const totalCredits = parseFloat(document.getElementById('totalCredits').value) || 0;
            const targetCgpa = parseFloat(document.getElementById('targetCgpa').value) || 0;




            // Initialize semester totals
            let semesterPoints = 0;
            let semesterCredits = 0;




            // Calculate total grade points and credit hours for the semester
            const courses = document.querySelectorAll('.course-entry');
            courses.forEach(course => {
                const creditHours = parseFloat(course.querySelector('input[name="creditHours[]"]').value) ||
                    0;
                const gradePoint = parseFloat(course.querySelector('select[name="grade[]"]').value) || 0;
                semesterPoints += creditHours * gradePoint;
                semesterCredits += creditHours;
            });




            // Calculate Semester GPA and Updated CGPA
            const semesterGpa = semesterCredits > 0 ? (semesterPoints / semesterCredits).toFixed(2) : '0.00';
            const updatedCgpa = totalCredits + semesterCredits > 0 ?
                ((currentCgpa * totalCredits + semesterPoints) / (totalCredits + semesterCredits)).toFixed(2) :
                '0.00';




            // Display Semester GPA and Updated CGPA
            document.getElementById('semesterGpa').innerText = semesterGpa;
            document.getElementById('updatedCgpa').innerText = updatedCgpa;




            // Calculate Required GPA for benchmarks and target CGPA
            const calculateRequiredGpa = (targetCgpa) => {
                return semesterCredits > 0 ?
                    ((targetCgpa * (totalCredits + semesterCredits)) - (currentCgpa * totalCredits)) /
                    semesterCredits :
                    0;
            };




            const requiredGpaForMinFirstClass = calculateRequiredGpa(3.50).toFixed(2);
            const requiredGpaForMaxFirstClass = calculateRequiredGpa(4.00).toFixed(2);
            const requiredGpaForTarget = calculateRequiredGpa(targetCgpa).toFixed(2);




            // Display the required GPA to reach the target CGPA
            document.getElementById('requiredGpa').innerText = requiredGpaForTarget > 0 ? requiredGpaForTarget :
                "N/A";




            // Display Forecasting Scenarios
            document.getElementById('reachMinFirstClass').innerText = requiredGpaForMinFirstClass > 0 ?
                requiredGpaForMinFirstClass :
                "N/A";
            document.getElementById('reachMaxFirstClass').innerText = requiredGpaForMaxFirstClass > 0 ?
                requiredGpaForMaxFirstClass :
                "N/A";
            document.getElementById('reachTargetCgpa').innerText = updatedCgpa >= targetCgpa ?
                "Achieved!" :
                `Requires at least ${requiredGpaForTarget} GPA this semester.`;




            // Show Results and Forecasting Section
            document.getElementById('result').style.display = 'block';
            document.getElementById('forecastSection').style.display = 'block';
        });
    </script>
@endsection

{{-- @extends('layouts.master')

@section('content')
    <div class="container mt-5">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Student Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.courses') }}">View Suggested Courses</a></li>
                        <li class="breadcrumb-item active">CGPA Calculator</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <h1 class="text-primary">Smart CGPA Calculator & Forecaster</h1>
            <p class="text-muted">Plan your academic success with ease! Calculate your GPA, forecast CGPA changes, and
                explore various scenarios.</p>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="calculatorTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="gpaCalculatorTab" data-bs-toggle="tab" href="#gpaCalculator" role="tab"
                    aria-controls="gpaCalculator" aria-selected="true">GPA/CGPA Calculator (One-time Input)</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="gpaForecastTab" data-bs-toggle="tab" href="#gpaForecast" role="tab"
                    aria-controls="gpaForecast" aria-selected="false">GPA/CGPA Forecaster (Historical Data)</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="calculatorTabsContent">
            <!-- One-time GPA/CGPA Calculator Tab -->
            <div class="tab-pane fade show active" id="gpaCalculator" role="tabpanel" aria-labelledby="gpaCalculatorTab">
                <form id="gpaCgpaForm" class="shadow p-4 rounded bg-light">
                    <!-- Current CGPA Details -->
                    <h4 class="text-secondary mb-4">GPA/CGPA Calculator</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="currentCgpa" class="form-label">Current CGPA</label>
                                <input type="number" class="form-control" id="currentCgpa" placeholder="e.g., 3.50"
                                    step="0.01" min="0" max="4.00">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="totalCredits" class="form-label">Total Credit Hours Completed</label>
                                <input type="number" class="form-control" id="totalCredits" placeholder="e.g., 90"
                                    min="0">
                            </div>
                        </div>
                    </div>

                    <!-- Target CGPA Input -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="targetCgpa" class="form-label">Target CGPA</label>
                            <input type="number" class="form-control" id="targetCgpa" placeholder="e.g., 3.75"
                                step="0.01" min="0" max="4.00">
                        </div>
                    </div>
                    <!-- New Semester Courses -->
                    <h4 class="text-secondary mb-4">New Semester Courses</h4>
                    <div id="coursesContainer">
                        <div class="row mb-3 course-entry">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Course Name" name="courseName[]">
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" placeholder="Credit Hours" name="creditHours[]"
                                    min="1">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="grade[]">
                                    <option value="" selected disabled>Grade</option>
                                    <option value="4.00">A (4.00)</option>
                                    <option value="3.67">A- (3.67)</option>
                                    <option value="3.33">B+ (3.33)</option>
                                    <option value="3.00">B (3.00)</option>
                                    <option value="2.67">B- (2.67)</option>
                                    <option value="2.33">C+ (2.33)</option>
                                    <option value="2.00">C (2.00)</option>
                                    <option value="1.67">C- (1.67)</option>
                                    <option value="1.33">D+ (1.33)</option>
                                    <option value="1.00">D (1.00)</option>
                                    <option value="0.00">F (0.00)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-4" id="addCourse">+ Add Another
                        Course</button>

                    <!-- Calculate Button -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-lg" id="calculateGpa">Calculate
                            GPA/CGPA</button>
                    </div>

                    <!-- Results -->
                    <div class="mt-5">
                        <h4 class="text-secondary">Results</h4>
                        <div class="alert alert-info text-center" id="result" style="display: none;">
                            <p class="mb-2"><strong>Semester GPA:</strong> <span id="semesterGpa"
                                    class="text-success"></span></p>
                            <p class="mb-2"><strong>Updated CGPA:</strong> <span id="updatedCgpa"
                                    class="text-success"></span></p>
                            <p><strong>Required GPA to Reach Target:</strong> <span id="requiredGpa"
                                    class="text-danger"></span></p>
                        </div>

                        <!-- Forecasting Section -->
                        <div id="forecastSection" class="mt-5">
                            <h4 class="text-secondary">Forecasting Scenarios</h4>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Reach 3.50 (Min First Class):</strong> <span id="reachMinFirstClass"></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Reach 4.00 (Max First Class):</strong> <span id="reachMaxFirstClass"></span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Reach Target CGPA:</strong> <span id="reachTargetCgpa"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- One-Time Input Section -->
                    <!--<h4 class="text-secondary mb-4">One-Time GPA/CGPA Input</h4>
                    <div class="mb-3">
                        <label for="currentCgpa" class="form-label">Current CGPA</label>
                        <input type="number" class="form-control" id="currentCgpa" placeholder="Enter Current CGPA"
                            step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="totalCredits" class="form-label">Total Credits Completed</label>
                        <input type="number" class="form-control" id="totalCredits" placeholder="Enter Total Credits"
                            min="0">
                    </div>
                    <div class="mb-3">
                        <label for="targetCgpa" class="form-label">Target CGPA</label>
                        <input type="number" class="form-control" id="targetCgpa" placeholder="Enter Target CGPA"
                            step="0.01">
                    </div>-->

                    <!-- Calculate Button -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-lg" id="calculateGpa">Calculate
                            GPA/CGPA</button>
                    </div>

                    <!-- Results -->
                    <div class="mt-5">
                        <h4 class="text-secondary">Results</h4>
                        <div class="alert alert-info text-center" id="result" style="display: none;">
                            <p class="mb-2"><strong>Updated CGPA Forecast:</strong> <span id="updatedCgpa"
                                    class="text-success"></span>
                            </p>
                            <p><strong>Required GPA to Reach Target (from now until the end):</strong> <span
                                    id="requiredGpa" class="text-danger"></span></p>
                        </div>

                        <!-- CGPA Performance Graph -->
                        <div class="mt-5">
                            <canvas id="cgpaGraph"></canvas>
                        </div>
                    </div>
                </form>
            </div>

            <!-- GPA/CGPA Forecaster (Historical Data) Tab -->
            <div class="tab-pane fade" id="gpaForecast" role="tabpanel" aria-labelledby="gpaForecastTab">
                <form id="forecastForm" class="shadow p-4 rounded bg-light">
                    <!-- Program Duration Details -->
                    <h4 class="text-secondary mb-4">Program Duration Details</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="yearsOfProgram" class="form-label">Years of Program</label>
                                <input type="number" class="form-control" id="yearsOfProgram" placeholder="e.g., 4"
                                    min="1">
                            </div>
                        </div>
                    </div>

                    <!-- Historical CGPA Inputs (Previous Semesters) -->
                    <h4 class="text-secondary mb-4">Historical CGPA Inputs</h4>
                    <div id="semestersContainer">
                        <div class="row mb-3 semester-entry">
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Semester Number (e.g., 1)"
                                    name="semesterNumber[]" min="1" max="8">
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="CGPA in this Semester"
                                    name="semesterCgpa[]" step="0.01" min="0" max="4.00">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-4" id="addSemester">+ Add Another
                        Semester</button>

                    <!-- Target CGPA Input for Forecast -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="targetForecastCgpa" class="form-label">Target CGPA for Forecast</label>
                            <input type="number" class="form-control" id="targetForecastCgpa" placeholder="e.g., 3.75"
                                step="0.01" min="0" max="4.00">
                        </div>
                    </div>

                    <!-- Forecast Button -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-lg" id="forecastGpa">Forecast GPA/CGPA</button>
                    </div>
                </form>

                <!-- Forecast Results -->
                <div class="mt-5">
                    <h4 class="text-secondary">Forecasting Results</h4>
                    <div class="alert alert-info text-center" id="forecastResult" style="display: none;">
                        <p class="mb-2"><strong>Forecasted CGPA by End of Program:</strong> <span id="forecastedCgpa"
                                class="text-success"></span>
                        </p>
                        <p><strong>Required GPA to Reach Target (for remaining semesters):</strong> <span
                                id="requiredForecastGpa" class="text-danger"></span></p>
                    </div>

                    <!-- Forecast Graph -->
                    <div class="mt-5">
                        <canvas id="forecastGraph"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Main CGPA Calculator
        document.getElementById('addCourse').addEventListener('click', function() {
            const courseContainer = document.getElementById('coursesContainer');
            const courseEntry =
                `<div class="row mb-3 course-entry">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Course Name" name="courseName[]">
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" placeholder="Credit Hours" name="creditHours[]" min="1">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="grade[]">
                    <option value="" selected disabled>Grade</option>
                    <option value="4.00">A (4.00)</option>
                    <option value="3.67">A- (3.67)</option>
                    <option value="3.33">B+ (3.33)</option>
                    <option value="3.00">B (3.00)</option>
                    <option value="2.67">B- (2.67)</option>
                    <option value="2.33">C+ (2.33)</option>
                    <option value="2.00">C (2.00)</option>
                    <option value="1.67">C- (1.67)</option>
                    <option value="1.33">D+ (1.33)</option>
                    <option value="1.00">D (1.00)</option>
                    <option value="0.00">F (0.00)</option>
                </select>
            </div>
        </div>`;
            courseContainer.insertAdjacentHTML('beforeend', courseEntry);
        });

        document.getElementById('calculateGpa').addEventListener('click', function() {
            // Fetch user inputs and ensure default values are set
            const currentCgpa = parseFloat(document.getElementById('currentCgpa').value) || 0;
            const totalCredits = parseFloat(document.getElementById('totalCredits').value) || 0;
            const targetCgpa = parseFloat(document.getElementById('targetCgpa').value) || 0;

            // Initialize semester totals
            let semesterPoints = 0;
            let semesterCredits = 0;

            // Calculate total grade points and credit hours for the semester
            const courses = document.querySelectorAll('.course-entry');
            courses.forEach(course => {
                const creditHours = parseFloat(course.querySelector('input[name="creditHours[]"]').value) ||
                    0;
                const gradePoint = parseFloat(course.querySelector('select[name="grade[]"]').value) || 0;
                semesterPoints += creditHours * gradePoint;
                semesterCredits += creditHours;
            });

            // Calculate Semester GPA and Updated CGPA
            const semesterGpa = semesterCredits > 0 ? (semesterPoints / semesterCredits).toFixed(2) : '0.00';
            const updatedCgpa = totalCredits + semesterCredits > 0 ?
                ((currentCgpa * totalCredits + semesterPoints) / (totalCredits + semesterCredits)).toFixed(2) :
                '0.00';

            // Display Semester GPA and Updated CGPA
            document.getElementById('semesterGpa').innerText = semesterGpa;
            document.getElementById('updatedCgpa').innerText = updatedCgpa;

            // Calculate Required GPA for benchmarks and target CGPA
            const calculateRequiredGpa = (targetCgpa) => {
                return semesterCredits > 0 ?
                    ((targetCgpa * (totalCredits + semesterCredits)) - (currentCgpa * totalCredits)) /
                    semesterCredits :
                    0;
            };

            document.getElementById('requiredGpa').innerText = requiredGpa > 0 ? requiredGpa.toFixed(2) : 'N/A';

            const requiredGpaForMinFirstClass = calculateRequiredGpa(3.50).toFixed(2);
            const requiredGpaForMaxFirstClass = calculateRequiredGpa(4.00).toFixed(2);
            const requiredGpaForTarget = calculateRequiredGpa(targetCgpa).toFixed(2);

            // Display the required GPA to reach the target CGPA
            document.getElementById('requiredGpa').innerText = requiredGpaForTarget > 0 ? requiredGpaForTarget :
                "N/A";

            // Display Forecasting Scenarios
            document.getElementById('reachMinFirstClass').innerText = requiredGpaForMinFirstClass > 0 ?
                requiredGpaForMinFirstClass : "N/A";
            document.getElementById('reachMaxFirstClass').innerText = requiredGpaForMaxFirstClass > 0 ?
                requiredGpaForMaxFirstClass : "N/A";
            document.getElementById('reachTargetCgpa').innerText = updatedCgpa >= targetCgpa ? "Achieved!" :
                `Requires at least ${requiredGpaForTarget} GPA this semester.`;

            // Show Results and Forecasting Section
            document.getElementById('result').style.display = 'block';
            document.getElementById('forecastSection').style.display = 'block';
        });

        // One-time GPA/CGPA Calculator
        document.getElementById('calculateGpa').addEventListener('click', function() {
            const currentCgpa = parseFloat(document.getElementById('currentCgpa').value) || 0;
            const totalCredits = parseFloat(document.getElementById('totalCredits').value) || 0;
            const targetCgpa = parseFloat(document.getElementById('targetCgpa').value) || 0;

            let totalPoints = currentCgpa * totalCredits;
            let accumulatedCgpa = currentCgpa;

            // Update CGPA Forecast
            let updatedCgpa = accumulatedCgpa;
            document.getElementById('updatedCgpa').innerText = updatedCgpa.toFixed(2);

            Calculate Required GPA
            const remainingCredits = (8 - 1) * 10; // Assuming 10 credits per semester, remaining 7 semesters
            const requiredGpa = ((targetCgpa * (totalCredits + remainingCredits)) - (currentCgpa * totalCredits)) /
                remainingCredits;

            document.getElementById('requiredGpa').innerText = requiredGpa > 0 ? requiredGpa.toFixed(2) : 'N/A';

            //Generate Graph
            generateCGPAGraph([updatedCgpa], updatedCgpa);

            // Display Result Section
            document.getElementById('result').style.display = 'block';
        });

        // Forecast GPA/CGPA Calculator (Historical Data)
        document.getElementById('forecastGpa').addEventListener('click', function() {
            const yearsOfProgram = parseInt(document.getElementById('yearsOfProgram').value) || 4;
            const totalSemesters = yearsOfProgram * 2;
            const targetForecastCgpa = parseFloat(document.getElementById('targetForecastCgpa').value) || 0;

            // Gather Historical Data
            let historicalCgpas = [];
            const semesterEntries = document.querySelectorAll('.semester-entry');
            semesterEntries.forEach(entry => {
                const semesterCgpa = parseFloat(entry.querySelector('input[name="semesterCgpa[]"]')
                    .value) || 0;
                historicalCgpas.push(semesterCgpa);
            });

            let totalCredits = 0;
            let totalPoints = 0;
            historicalCgpas.forEach(cgpa => {
                totalPoints += cgpa * 10; // Assuming 10 credits per semester
                totalCredits += 10;
            });

            let currentCgpa = totalPoints / totalCredits;
            let requiredGpaForForecast = ((targetForecastCgpa * (totalCredits + (totalSemesters - historicalCgpas
                .length) * 10)) - totalPoints) / ((totalSemesters - historicalCgpas.length) * 10);

            // Update Forecast Results
            document.getElementById('forecastedCgpa').innerText = currentCgpa.toFixed(2);
            document.getElementById('requiredForecastGpa').innerText = requiredGpaForForecast > 0 ?
                requiredGpaForForecast.toFixed(2) : 'N/A';

            // Generate Forecast Graph
            generateForecastGraph(historicalCgpas, currentCgpa);

            // Display Forecasting Section
            document.getElementById('forecastResult').style.display = 'block';
        });

        // Function to generate CGPA Graph (for one-time calculation)
        function generateCGPAGraph(semesters, currentCgpa) {
            const ctx = document.getElementById('cgpaGraph').getContext('2d');
            const labels = Array.from({
                length: semesters.length
            }, (_, i) => `Sem ${i + 1}`);
            const data = semesters.map(() => currentCgpa);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'CGPA Performance Forecast',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'CGPA Forecast over Semesters'
                        }
                    }
                }
            });
        }

        // Function to generate Forecast Graph (for historical data)
        function generateForecastGraph(semesters, currentCgpa) {
            const ctx = document.getElementById('forecastGraph').getContext('2d');
            const labels = Array.from({
                length: semesters.length
            }, (_, i) => `Sem ${i + 1}`);
            const data = semesters.map(() => currentCgpa);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Forecast CGPA Performance',
                        data: data,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'CGPA Forecast based on Historical Data'
                        }
                    }
                }
            });
        }
    </script>
@endsection --}}
