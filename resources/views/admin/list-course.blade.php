@extends('layouts.master')

@section('content')

</head>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align">
            <div class="col">
                <h3 class="page-title">Courses</h3>
            </div>
        </div>
    </div>

    <div class="row align">
        <form action="{{ route('admin.courses') }}" method="GET" class="row align">
            <!-- Search by Course Code -->
            <div class="col-lg-3 col-md-6 mb-3 mb-md-0">
                <div class="form-group">
                    <input type="text" name="course_code" class="form-control" placeholder="Search by Course Code ..." value="{{ request('course_code') }}">
                </div>
            </div>
            <!-- Search by Course Title -->
            <div class="col-lg-3 col-md-6 mb-3 mb-md-0">
                <div class="form-group">
                    <input type="text" name="course_title" class="form-control" placeholder="Search by Course Title ..." value="{{ request('course_title') }}">
                </div>
            </div>
            <!-- Search Button -->
            <div class="col-lg-2 col-md-6 mb-3 mb-md-0">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
            <!-- Add Course Button -->
            <div class="col-lg-4 col-md-6 mb-3 mb-md-0 text-end">
                <a href="{{ route('admin.course.add') }}" class="btn btn-primary">
                    <i class="feather feather-plus-circle"></i> Add Course
                </a>
            </div>
        </form>
    </div>

<div class="card report-card">
        <div class="card-body pb-0">
            <form method="GET" action="{{ route('admin.courses') }}">
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
                        <a href="{{ route('admin.courses') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
</div>

<form id="bulkDeleteForm" action="{{ route('admin.courses.bulkDelete') }}" method="POST">
    @csrf
    @method('DELETE')

    <div class="table-responsive">
        @if($courses->count() > 0)
        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
            <thead class="student-thread">
                <tr>
                    <th>
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Credit Hour</th>
                    <th>Pre-Requisite</th>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Category</th>
                    <th>Department</th>
                    <th>Specialization</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>
                        <input type="checkbox" name="course_codes[]" value="{{ $course->course_code }}">
                    </td>
                    <td>
                        <a href="{{ route('admin.course.edit', $course->course_code) }}"
                            class="text-primary text-decoration-underline"
                            title="Click to edit this course">
                            {{ $course->course_code }}
                        </a>
                    </td>
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
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger mt-3">Delete Selected</button>
</form>
@else
<div class="alert alert-warning text-center">
    No courses found.
</div>
@endif
</div>


</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal custom-modal fade" id="save_invocies_details" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Save Subject Details</h3>
                    <p>Are you sure want to save?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal"
                                class="btn btn-primary paid-continue-btn">Save</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal"
                                class="btn btn-primary paid-cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<body>
    <html>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input[name="course_ids[]"]');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
                });
            }
        });
    </script>

</body>

</html>
@endsection