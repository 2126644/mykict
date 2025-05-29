@extends('layouts.master')

@section('content')

<div class="content container-fluid">

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Welcome {{ $student->st_name }}!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Student Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.courses') }}">View Suggested Courses</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('cgpa.calculator') }}">CGPA Calculator</a>
                        </li>
                    </ul>
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
                        <h6>Major</h6>
                        <h3>{{ $student->major }}</h3>
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
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="card flex-fill comman-shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Study Plan Summary </h5>
                            <p>for Upcoming Semester</p>
                        </div>
                        <div class="col-6">
                            <ul class="chart-list-out">

                                <li class="lesson-view-all"><a href="{{ route('student.courses') }}">View Study Plan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="dash-circle">
                    <div class="row">
                        <div class="col-lg-3 col-md-12 dash-widget1">
                            <div class="circle-bar circle-bar2">
                                <div class="circle-graph2" data-percent="75">
                                    <b>75%</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="dash-details">
                                <div class="lesson-activity">
                                    <div class="lesson-imgs">
                                        <img src="assets/img/icons/lesson-icon-01.svg" alt="">
                                    </div>
                                    <div class="views-lesson">
                                        <h5>Total subjects </h5>
                                        <h4>6</h4>
                                    </div>
                                </div>
                                <div class="lesson-activity">
                                    <div class="lesson-imgs">
                                        <img src="assets/img/icons/lesson-icon-02.svg" alt="">
                                    </div>
                                    <div class="views-lesson">
                                        <h5>Total Credit Hours</h5>
                                        <h4>13.5</h4>
                                    </div>
                                </div>
                                <div class="lesson-activity">
                                    <div class="lesson-imgs">
                                        <img src="assets/img/icons/lesson-icon-03.svg" alt="">
                                    </div>
                                    <div class="views-lesson">
                                        <h5>Credit Hours Completed</h5>
                                        <h4>110/132</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="dash-details">
                                <div class="lesson-activity">
                                    <div class="lesson-imgs">
                                        <img src="assets/img/icons/lesson-icon-04.svg" alt="">
                                    </div>

                                    @php
                                    $semLeft = max(0, 8 - ($student->year * 2));
                                    @endphp

                                    <div class="views-lesson">
                                        <h5>Semester Left</h5>
                                        <h4>{{ $semLeft }} {{ $semLeft === 1 ? 'sem' : 'sem' }}</h4>
                                    </div>
                                </div>
                                <div class="lesson-activity">
                                    <div class="lesson-imgs">
                                        <img src="assets/img/icons/lesson-icon-05.svg" alt="">
                                    </div>
                                    <div class="views-lesson">
                                        <h5>Specialization</h5>
                                        <h4>{{ $student->specialization }}</h4>
                                    </div>
                                </div>
                                <div class="lesson-activity">
                                    <div class="lesson-imgs">
                                        <img src="assets/img/icons/lesson-icon-06.svg" alt="">
                                    </div>

                                    @php
                                    $yearsLeft = max(0, 4 - $student->year);
                                    @endphp

                                    <div class="views-lesson">
                                        <h5>Years Left</h5>
                                        <h4>{{ $yearsLeft }} {{ $yearsLeft === 1 ? 'year' : 'years' }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 d-flex align-items-center justify-content-center">
                            <div class="skip-group">
                                <!--<button type="submit" href="{{ url('update-profile') }}" class="btn btn-info skip-btn">Edit</button>-->
                                <form action="{{ url('update-profile') }}" method="get">
                                    <button type="submit" class="btn btn-info skip-btn">Edit</button>
                                </form>

                                <button type="submit" class="btn btn-info continue-btn">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">GPA/CGPA Tracker</h5>
                                </div>
                                <!-- GPA/CGPA Chart -->
                                <div class="card-body">
                                    <div id="gpaCgpaChart" style="height: 350px;">
                                        <!-- <div class="col-6">
                                                    <ul class="chart-list-out">
                                                        <li><span class="circle-blue"></span>CGPA</li>
                                                        <li><span class="circle-green"></span>GPA</li>
                                                        <li class="star-menus"><a href="javascript:;"><i
                                                                    class="fas fa-ellipsis-v"></i></a></li>
                                                    </ul>
                                            </div>  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-body">
                        <div id="calendar-doctor" class="calendar-container"></div>
                        <div class="calendar-info calendar-info1">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mt-0">Upcoming Subjects</h4>
                                </div>
                                <!-- Display the upcoming semester/year dynamically -->
                                <!-- Calculate $nextSem and $nextYear in controller and pass to view -->
                                <div>
                                    <h4 class="mt-0">Semester {{ $nextSem }}, {{ $nextYear }}/{{ $nextYear + 1 }}</h4>
                                </div>
                            </div>

                            @forelse ($upcomingSubjects as $subject)
                            <div class="mb-3">
                                <div class="p-3 rounded shadow-sm d-flex justify-content-between align-items-center" style="background: #f8fafc;">
                                    <div>
                                        <div class="fw-bold" style="font-size: 1rem;">{{ $subject->course_code }} - {{ $subject->course_title }}</div>
                                        {{-- <div style="font-size: 0.95rem; color: #789;">Target Grade: {{ $subject->target_grade ?? '-' }}</div> --}}
                                    </div>
                                    <div>
                                        <span class="badge text-dark" style="font-size: 1rem;">Credit Hour: {{ $subject->credit_hrs ?? '-' }}</span>
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
