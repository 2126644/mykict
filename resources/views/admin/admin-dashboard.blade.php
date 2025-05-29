@extends('layouts.master')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Welcome {{ $admin->ad_name }}!</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-sm-6 col-12 d-flex">
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

        <div class="col-xl-6 col-sm-6 col-12 d-flex">
            <div class="card bg-comman w-100">
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

    {{-- <div class="card report-card">
        <div class="card-body pb-0">
            <form method="GET" action="{{ route('admin.dashboard') }}">
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
                        <label for="year" class="form-label">Select Year</label>
                        <select name="year" id="year" class="form-select">
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
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

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
                            <a class="dropdown-item" href="{{ route('admin.course.edit', $course->course_code) }}"><i class="far fa-edit me-2"></i>Edit</a>
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
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                            <span><i class="fas fa-users"></i> Total Students</span>
                            <h6 class="mb-0">{{ $course->total_students ?? 'N/A' }}</h6>
                        </div>
                        <div class="col-auto">
                            <span><i class="fas fa-chalkboard-teacher"></i> Number of Sections</span>
                            <h6 class="mb-0">{{ $course->sections ?? 'N/A' }}</h6>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('admin.course.edit', $course->course_code) }}" class="btn btn-primary">
                                <i class="far fa-edit me-2"></i>Edit
                            </a>
                        </div>
                        <div class="col-auto">
                            <form
                                action="{{ route('admin.course.delete', $course->course_code) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete {{ $course->course_code }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt me-1"></i>Delete
                                </button>
                            </form>
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
