@extends('layouts.master')

@section('content')

</head>

<div class="content container-fluid">

    <div class="page-header">
        <div class="row align">
            <div class="col">
                <h3 class="page-title">Courses</h3>
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('adminSSP.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Course</li>
                <li class="breadcrumb-item"><a href="{{ route('add.studyplan') }}">Study Plan</a></li>
                </ul> --}}
            </div>
        </div>
    </div>

    <div class="row align">
        <form action="{{ route('list.course') }}" method="GET" class="row align">
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
            <div class="col-lg-4 col-md-6 justify-content-end">
                <a href="add-course" class="btn btn-primary">
                    <i class="feather feather-plus-circle"></i> Add Course
                </a>
            </div>
        </form>
    </div>




    <div class="card report-card">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-md-12">
                    <ul class="app-listing">
                        <li>
                            <div class="multipleSelection">
                                <div class="selectBox">
                                    <p class="mb-0"><i class="fas fa-user-plus me-1 select-icon"></i> Select Department</p>
                                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div id="checkBoxes">
                                    <form action="#">
                                        <p class="checkbox-title">Customer Search</p>
                                        <div class="form-custom">
                                            <input type="text" class="form-control bg-grey" placeholder="Enter Customer Name">
                                        </div>
                                        <div class="selectBox-cont">
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> Brian Johnson
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> Russell Copeland
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> Greg Lynch
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> John Blair
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> Barbara Moore
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> Hendry Evan
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="username">
                                                <span class="checkmark"></span> Richard Miles
                                            </label>
                                        </div>
                                        <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                        <button type="reset" class="btn w-100 btn-grey">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="multipleSelection">
                                <div class="selectBox">
                                    <p class="mb-0"><i class="fas fa-calendar me-1 select-icon"></i> Select Specialization</p>
                                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div id="checkBoxes">
                                    <form action="#">
                                        <p class="checkbox-title">Date Filter</p>
                                        <div class="selectBox-cont selectBox-cont-one h-auto">
                                            <div class="date-picker">
                                                <div class="form-custom cal-icon">
                                                    <input class="form-control datetimepicker" type="text" placeholder="Form">
                                                </div>
                                            </div>
                                            <div class="date-picker pe-0">
                                                <div class="form-custom cal-icon">
                                                    <input class="form-control datetimepicker" type="text" placeholder="To">
                                                </div>
                                            </div>
                                            <div class="date-list">
                                                <ul>
                                                    <li><a href="#" class="btn date-btn">Today</a></li>
                                                    <li><a href="#" class="btn date-btn">Yesterday</a></li>
                                                    <li><a href="#" class="btn date-btn">Last 7 days</a></li>
                                                    <li><a href="#" class="btn date-btn">This month</a></li>
                                                    <li><a href="#" class="btn date-btn">Last month</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="multipleSelection">
                                <div class="selectBox">
                                    <p class="mb-0"><i class="fas fa-bookmark me-1 select-icon"></i> Select Category</p>
                                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                </div>
                                <div id="checkBoxes">
                                    <form action="#">
                                        <p class="checkbox-title">Category</p>
                                        <div class="form-custom">
                                            <input type="text" class="form-control bg-grey" placeholder="Enter Category Name">
                                        </div>
                                        <div class="selectBox-cont">
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="category">
                                                <span class="checkmark"></span> Kulliyyah Required Course
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="category">
                                                <span class="checkmark"></span> Department Required Course
                                            </label>
                                        </div>
                                        <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                        <button type="reset" class="btn w-100 btn-grey">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
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
</body>

</html>
@endsection