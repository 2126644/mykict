@extends('layouts.master')

@section('content')

<!-- Head section -->
{{-- <head>
    <link rel="stylesheet" href="assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">
</head> --}}

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Course</h3>
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('SSP.welcome') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('SSP.dashboard') }}">Student Dashboard</a></li>
                    <li class="breadcrumb-item active">View Suggested Courses</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cgpa.calculator') }}">CGPA Calculator</a></li>
                </ul> --}}
            </div>
        </div>
    </div>

    <div class="student-group-form">
        <div class="row">
            <form action="{{ route('view.course') }}" method="GET" class="row align">
            <!-- Search by Course Code -->
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" name="course_code" class="form-control" placeholder="Search by Course Code ..." value="{{ request('course_code') }}">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" name="course_title" class="form-control" placeholder="Search by Course Title ..." value="{{ request('course_title') }}">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="search-student-btn">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Suggested Courses</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>Download</a>
                               <!-- <a href="add-subject.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>-->
                                <a href="javascript:void(0);" class="add-btn me-2"><i class="fas fa-plus-circle"></i></a>
                            </div>
                        </div>
                    </div>

                    
    <div class="table-responsive">
        @if($courses->count() > 0)
        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
            <thead class="student-thread">
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Credit Hour</th>
                    <th>Pre-Requisite</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Category</th>
                    <th>Department</th>
                    <th>Specialization</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->course_code }}</td>
                    <td>
                        <h2>
                            <a>{{ $course->course_title }}</a>
                        </h2>
                    </td>
                    <td>{{ $course->credit_hrs }}</td>
                    <td>{{ $course->pre_requisites }}</td>
                    <td>{{ $course->year }}</td>
                    <td>{{ $course->sem }}</td>
                    <td>{{ $course->category }}</td>
                    <td>{{ $course->department }}</td>
                    <td>{{ $course->specialization }}</td>
                    <td class="text-end">
                        <div class="actions">
                            <a href="edit-course" class="btn btn-sm bg-danger-light">
                                <i class="feather-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-warning text-center">
            No courses found.
        </div>
        @endif
    </div>

                    <!-- Save button at the bottom of the page -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="javascript:void(0);" class="btn btn-primary" onclick="saveSubjectDetails()">Save</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal for Save Confirmation -->
<div class="modal custom-modal fade" id="save_invocies_details" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Save Subject Details</h3>
                    <p>Are you sure you want to save?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Save</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
{{-- <script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/script.js"></script> --}}

<script>
    function saveSubjectDetails() {
        // Logic for saving subject details can go here.
        alert("Subject details saved!");
        // Perform backend actions to save the data (e.g., AJAX or form submission).
    }
</script>

@endsection
