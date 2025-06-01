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
    .db-icon img {
        width: 50px;
        opacity: 0.7;
    }
    .db-widgets {
        padding: 10px;
    }
    /* .dash-details h4 {
        font-weight: bold;
        color: #34495e;
    }
    .lesson-imgs img {
        width: 30px;
        margin-right: 10px;
    }
    .lesson-activity {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .dash-circle .col-lg-3 {
        margin-top: 20px;
    }

    .dash-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; /* Center the content horizontally */

/* Optional: Mobile responsiveness */
@media (max-width: 768px) {
    .dash-details {
        flex-direction: row; /* Stack columns in a row on smaller screens */
    }
}

</style>

<div class="content container-fluid">

    <div class="page-header">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Welcome {{ $student->st_name }}!</h3>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Matric No</h6>
                        <h3>{{ $student->matric_no }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Name</h6>
                        <h3>{{ $student->st_name }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Programme</h6>
                        <h3>{{ $student->programme }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/teacher-icon-02.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Specialization</h6>
                        <h3>{{ $student->specialization }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/teacher-icon-02.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Year</h6>
                        <h3>{{ $student->year }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/student-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Semester</h6>
                        <h3>{{ $student->sem }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/student-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Current CGPA</h6>
                        <h3>{{ $student->current_cgpa }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/student-icon-02.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Targeted CGPA</h6>
                        <h3>{{ $student->target_cgpa }}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="assets/img/icons/student-icon-02.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
<div class="col-12 col-lg-12 col-xl-8">
<div class="card flex-fill comman-shadow">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Study Plan Summary</h5>
<p>for Upcoming Semester</p>
</div>
</div>
</div>
<div class="dash-circle">
<div class="row justify-content-center align-items-center">
    @php
    // Compute semester number 
    // e.g. Year 1 Sem 1 → semIndex 1, Year 1 Sem 2 → semIndex 2, …, Year 4 Sem 2 → semIndex 8
    $semIndex = ($student->year - 1) * 2 + $student->sem;

    // year 4 sem 2 student = 100% complete
    $percent = round($semIndex / 8 * 100);
    @endphp
<div class="col-lg-3 col-md-3 dash-widget1 align-items-center justify-content-center">
<div class="circle-bar circle-bar2">
<div class="circle-graph2" data-percent="{{ $percent }}">
<b>{{ $percent }}%</b>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 justify-content-center align-items-center">
<div class="dash-details">
<div class="lesson-activity">
<div class="lesson-imgs">
<img src="assets/img/icons/lesson-icon-01.svg" alt="">
</div>
<div class="views-lesson">
<h5>Total Subject</h5>
<h4>{{ $totalSubjects }}</h4>
</div>
</div>
<div class="lesson-activity">
<div class="lesson-imgs">
<img src="assets/img/icons/lesson-icon-02.svg" alt="">
</div>
<div class="views-lesson">
<h5>Total Credit Hour</h5>
<h4>{{ $totalCreditHours }}</h4>
</div>
</div>

</div>
</div>
<div class="col-lg-3 col-md-3 justify-content-center align-items-center">
<div class="dash-details">
<div class="lesson-activity">
<div class="lesson-imgs">
<img src="assets/img/icons/lesson-icon-04.svg" alt="">
</div>
@php
$yearsLeft = max(0, 4 - $student->year);
@endphp
<div class="views-lesson">
<h5>Year Left</h5>
<h4>{{ $yearsLeft }} {{ $yearsLeft === 1 ? 'year' : 'years' }}</h4>
</div>
</div>
<div class="lesson-activity">
<div class="lesson-imgs">
<img src="assets/img/icons/lesson-icon-05.svg" alt="">
</div>
@php
$semLeft = max(0, 8 - ($student->year * 2));
@endphp
<div class="views-lesson">
<h5>Semester Left</h5>
<h4>{{ $semLeft }} {{ $semLeft === 1 ? 'semester' : 'semesters' }}</h4>
</div>
</div>

</div>
</div>

<div class="col-lg-3 col-md-3 d-flex justify-content-center align-items-center">
<div class="skip-group">
<a href="{{ route('update.profile') }}" class="btn btn-info skip-btn">Edit Profile</a>
<a href="{{ route('student.courses') }}" class="btn btn-info continue-btn">View Study Plan</a>
</div>
</div>

</div>
</div>
</div>

                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">GPA/CGPA Tracker</h5>
                                </div>
                                <!-- GPA/CGPA Chart -->
                                <div class="card-body">
                                    <div id="gpaCgpaChart" style="height: 350px;">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

<div class="col-12 col-lg-12 col-xl-4 d-flex">
<div class="card flex-fill comman-shadow">
<div class="card-body">
<div id="calendar-doctor" class="calendar-container"></div>
<div class="calendar-info calendar-info1">
<div class="up-come-header">
<h3>Upcoming Subjects</h3>
</div>
<h4>Semester {{ $nextSem }}, {{ date('Y') }}/{{ date('Y')+1 }}</h4>

@forelse ($upcomingSubjects as $subject)
<div class="calendar-details">
<p>{{ $subject->course_code }}</p>
<div class="calendar-box normal-bg">
<div class="calandar-event-name">
<h4>{{ $subject->course_title }}</h4>
<h5>Target Grade: {{ $subject->target_grade ?? '-' }}</h5>
<h5>Credit Hour: {{ $subject->credit_hrs }}</h5>
</div>
</div>
</div>
@empty
<div class="alert alert-warning mb-3">
No upcoming subjects added yet!
</div>
@endforelse

</div>
</div>
</div>
</div>
</div>
</div>

    <!-- UPDATED SCRIPT FOR CGPA TRACKER-->
    <script src="assets/js/jquery-3.6.0.min.js"></script> <!--assets ni yg buat tepi2 takleh tekan and circle tu ada bentuk-->
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script>
        var options = {
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                },
            },
            series: [{
                    name: 'GPA',
                    data: @json($gpa),
                },
                {
                    name: 'CGPA',
                    data: @json($cgpa),
                }
            ],
            xaxis: {
                categories: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'],
                title: {
                    text: 'Semester'
                }
            },
            yaxis: {
                title: {
                    text: 'GPA/CGPA'
                },
                min: 2.5,
                max: 4,
            },
            colors: ['#1E90FF', '#32CD32'],
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            markers: {
                size: 4
            }
        };

        var chart = new ApexCharts(document.querySelector("#gpaCgpaChart"), options);
        chart.render();
    </script>
    <script async type='module' src='https://interfaces.zapier.com/assets/web-components/zapier-interfaces/zapier-interfaces.esm.js'></script>
    <zapier-interfaces-chatbot-embed is-popup='true' chatbot-id='cmb8x30m4002qwowpp0bbi4k2'></zapier-interfaces-chatbot-embed>
    {{-- <script>
            // ApexCharts Configuration for GPA/CGPA
            var options = {
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                },
                series: [{
                        name: 'GPA',
                        data: [3.2, 3.4, 3.5, 3.6, 3.7, 3.8]
                    },
                    {
                        name: 'CGPA',
                        data: [3.2, 3.3, 3.4, 3.5, 3.54, 3.6]
                    }
                ],
                xaxis: {
                    categories: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6'],
                    title: {
                        text: 'Semesters'
                    }
                },
                yaxis: {
                    title: {
                        text: 'GPA/CGPA'
                    }
                },
                colors: ['#1E90FF', '#32CD32'],
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                markers: {
                    size: 4
                }
            };
            var chart = new ApexCharts(document.querySelector("#gpaCgpaChart"), options);
            chart.render();
        </script>--}}

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/js/circle-progress.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    </body>
    @endsection
