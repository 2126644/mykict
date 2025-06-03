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
        <!-- Current CGPA & Target CGPA from students table -->
        <h4 class="text-secondary mb-4">Current CGPA Details</h4>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="currentCgpa" class="form-label">Current CGPA</label>
                    <input type="number" class="form-control" id="currentCgpa" name="currentCgpa"
       value="{{ $student->current_cgpa ?? '' }}" placeholder="e.g., 3.50" step="0.01" min="0" max="4.00">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="targetCgpa" class="form-label">Target CGPA</label>
                    <input type="number" class="form-control" id="targetCgpa" name="targetCgpa"
       value="{{ $student->target_cgpa ?? '' }}" placeholder="e.g., 3.75" step="0.01" min="0" max="4.00">
                </div>
            </div>
        </div>




        <!-- Total Credit Hours Completed Input -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="totalCredits" class="form-label">Total Credit Hours Completed</label>
                <!-- // Accept only whole numbers (integers), positive , not allow decimals -->
                <input type="number" class="form-control" id="totalCredits" name="totalCredits" placeholder="e.g., 90" min="0" step="1">
            </div>
        </div>

        <!-- New Semester Courses -->
<h4 class="text-secondary mb-4">New Semester Courses</h4>
<div id="coursesContainer">
    <!-- Each row will be pre-filled with the course title and credit hours  -->
     <!-- You're already showing all saved preferences ($courses from controller).
      Users aren’t meant to change them in this form.
      simplifies the UI and avoids confusion from a partially populated dropdown. -->
    @foreach ($courses as $course)
        <div class="row mb-3 course-entry">
            <div class="col-md-6">
                <input type="text" class="form-control course-select" name="courseName[]" value="{{ $course->course_title }}" readonly>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control credit-hours" name="creditHours[]" value="{{ $course->credit_hrs }}" readonly>
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
    @endforeach
</div>


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

        <div id="forecastSection" style="display: none;"></div>

        <script async type='module' src='https://interfaces.zapier.com/assets/web-components/zapier-interfaces/zapier-interfaces.esm.js'></script>
        <zapier-interfaces-chatbot-embed is-popup='true' chatbot-id='cmb8x30m4002qwowpp0bbi4k2'></zapier-interfaces-chatbot-embed>

        <script>
            const courseMap = @json($courses->pluck('credit_hrs', 'course_title'));

            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('course-select')) {
                    const selectedCourse = e.target.value;
                    const creditInput = e.target.closest('.course-entry').querySelector('.credit-hours');
                    creditInput.value = courseMap[selectedCourse] || '';
                }
            });
        </script>

        <script>

            document.getElementById('calculateGpa').addEventListener('click', function() {
                // Fetch user inputs with validation
                const currentCgpa = parseFloat(document.getElementById('currentCgpa').value) || 0;
                const totalCredits = parseFloat(document.getElementById('totalCredits').value) || 0;
                const targetCgpa = parseFloat(document.getElementById('targetCgpa').value) || 0;

                // Validate inputs
                if (currentCgpa > 4.0 || targetCgpa > 4.0) {
                    alert("CGPA cannot exceed 4.0");
                    return;
                }

                // Calculate semester performance
                let semesterPoints = 0;
                let semesterCredits = 0;
                const courses = document.querySelectorAll('.course-entry');

                courses.forEach(course => {
                    const creditHours = parseFloat(course.querySelector('input[name="creditHours[]"]').value) || 0;
                    const gradePoint = parseFloat(course.querySelector('select[name="grade[]"]').value) || 0;
                    semesterPoints += creditHours * gradePoint;
                    semesterCredits += creditHours;
                });

                // Calculate results
                const semesterGpa = semesterCredits > 0 ? (semesterPoints / semesterCredits) : 0;
                const totalPoints = (currentCgpa * totalCredits) + semesterPoints;
                const totalCompletedCredits = totalCredits + semesterCredits;
                const updatedCgpa = totalCompletedCredits > 0 ? (totalPoints / totalCompletedCredits) : 0;

                // Calculate remaining requirements (assuming standard 125 credit program)
                const remainingCredits = 125 - totalCompletedCredits;
                const remainingSemesters = Math.ceil(remainingCredits / 18); // Assuming 18 credits/semester

                // Calculate required future performance
                const calculateRequiredFutureGPA = (target) => {
                    if (remainingCredits <= 0) return target >= updatedCgpa ? "Achieved!" : "Target not met";
                    return ((target * 125) - totalPoints) / remainingCredits;
                };

                const reqForTarget = calculateRequiredFutureGPA(targetCgpa);
                const reqForFirstClass = calculateRequiredFutureGPA(3.5);
                const reqForPerfect = calculateRequiredFutureGPA(4.0);

                // Generate motivational messages
                let motivationMessage = "";
                let warningMessage = "";

                if (reqForTarget > 4.0) {
                    warningMessage = "⚠ Your target requires impossible grades. Consider adjusting your target CGPA.";
                    motivationMessage = "💪 While your current target is very ambitious, focus on consistent improvement!";
                } else if (reqForTarget > 3.67) {
                    warningMessage = "⚠ Challenging target! You'll need mostly A/A- in remaining courses.";
                    motivationMessage = "🎯 This will require strong commitment, but is achievable with dedication!";
                } else if (reqForTarget > 3.50) {
                    warningMessage = "⚠ Challenging target! You'll need mostly A/A-/B+ in remaining courses.";
                    motivationMessage = "🎯 This will require strong commitment, but is achievable with dedication!";
                } else if (updatedCgpa >= targetCgpa) {
                    if (updatedCgpa >= 4.0) {
                        motivationMessage = "🎉 Congratulations! You'll be one of the 4 Flat Achiever! Keep it up and Flying HIGH!";
                    } else if (updatedCgpa >= 3.5) {
                        motivationMessage = "🎉 Congratulations! You'll be one of the Dean List Recepient! Let's focus to make it real for the next semester!";
                    } else {
                        motivationMessage = "🎉 Congratulations! You're on track to meet your goal! Keep up the good work!";
                    }
                } else {
                    motivationMessage = "✨ You're making progress! Stay focused and you can reach your target!";
                }
                // Display results
                document.getElementById('semesterGpa').innerText = semesterGpa.toFixed(2);
                document.getElementById('updatedCgpa').innerText = updatedCgpa.toFixed(2);

                // Enhanced result display
                let resultHTML = `
                <p class="mb-2"><strong>Semester GPA:</strong> <span class="text-success">${semesterGpa.toFixed(2)}</span></p>
                <p class="mb-2"><strong>Updated CGPA:</strong> <span class="text-success">${updatedCgpa.toFixed(2)}</span></p>
                <p class="mb-2"><strong>Credits Completed:</strong> ${totalCompletedCredits}/125</p>
                <p class="mb-2"><strong>Estimated Remaining Semesters:</strong> ${remainingSemesters}</p>
            `;

                if (warningMessage) {
                    resultHTML += `<div class="alert alert-warning mt-3">${warningMessage}</div>`;
                }

                resultHTML += `
                <div class="alert alert-success mt-3">${motivationMessage}</div>
                <hr>
                <h5 class="mt-3">Forecast Scenarios</h5>
               <ul class="list-group mt-2">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>First Class (3.50+):</strong></span>
                        <span class="badge ${reqForFirstClass <= 4.0 ? 'bg-success' : 'bg-danger'} rounded-pill">
                            ${reqForFirstClass <= 4.0 ? 'Average GPA you need to maintain in future semesters ' + reqForFirstClass.toFixed(2) : 'Not possible'}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Perfect 4.00:</strong></span>
                        <span class="badge ${reqForPerfect <= 4.0 ? 'bg-success' : 'bg-danger'} rounded-pill">
                            ${reqForPerfect <= 4.0 ? 'Average GPA you need in future semesters ' + reqForPerfect.toFixed(2) : 'Not possible'}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Your Target (${targetCgpa.toFixed(2)}):</strong></span>
                        <span class="badge ${reqForTarget <= 4.0 ? 'bg-primary' : 'bg-danger'} rounded-pill">
                            ${reqForTarget <= 4.0 ? 'Need to maintain GPA atleast ' + reqForTarget.toFixed(2) : 'Not possible'}
                        </span>
                    </li>
                </ul>
            `;

                document.getElementById('result').innerHTML = resultHTML;
                document.getElementById('result').style.display = 'block';
                document.getElementById('forecastSection').style.display = 'block';
            });
        </script>

        <div id="forecastSection" style="display: none;"></div>

        @endsection
