@extends('layouts.master')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{ $admin->ad_name }}!</h3>
                        {{-- <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('list.course') }}">Course</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('add.studyplan') }}">Study Plan</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-auto col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Admin ID</h6>
                                <h3>{{ $admin->admin_id }}</h3>
                                <h6>Name</h6>
                                <h3>{{ $admin->ad_name }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-auto col-sm-6 col-12 d-flex">
                <div class="card bg-comman">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Email</h6>
                                <h3>{{ $admin->ad_email }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="assets/img/icons/teacher-icon-02.svg" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card invoices-tabs-card border-0">
            <div class="card-body card-body pt-0 pb-0">
                <div class="invoices-main-tabs border-0 pb-0">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="invoices-settings-btn invoices-settings-btn-one">
                                <a href="add-course" class="btn">
                                    <i class="feather feather-plus-circle"></i> New Course
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card report-card">
            <div class="card-body pb-0">
                <form method="GET" action="{{ route('adminSSP.dashboard') }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="department" class="form-label">Select Department</label>
                    <select name="department" id="department" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-3 mb-3">
                    <label for="specialization" class="form-label">Select Specialization</label>
                    <select name="specialization" id="specialization" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($specializations as $spec)
                            <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                {{ $spec }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-3 mb-3">
                    <label for="year_semester" class="form-label">Select Year</label>
                    <select name="year_semester" id="year_semester" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-3 mb-3">
                    <label for="category" class="form-label">Select Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <a href="{{ route('adminSSP.dashboard') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

        <div class="row">
            @forelse($courses as $course)
            <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
                <div class="card invoices-grid-card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="#" class="invoice-grid-link">{{ $course->course_code }}</a>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i class="far fa-edit me-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="far fa-eye me-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="far fa-trash-alt me-2"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-middle">
                        <h2 class="card-middle-avatar">
                            <a href="#">{{ $course->course_title }}</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><i class="far fa-money-bill-alt"></i> Total Students</span>
                                <h6 class="mb-0">{{ $course->total_students ?? 'N/A' }}</h6>
                            </div>
                            <div class="col-auto">
                                <span><i class="far fa-calendar-alt"></i> Number of Sections</span>
                                <h6 class="mb-0">{{ $course->sections ?? 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="badge bg-success-dark">{{ $course->status ?? 'Open' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No courses found for the selected filters.
                </div>
            </div>
        @endforelse
        </div>
</div>



    {{-- <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>


    <script src="assets/js/circle-progress.min.js"></script>

    <script src="assets/js/script.js"></script> --}}
    </body>
@endsection
