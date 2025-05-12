@extends('layouts.master')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{ $admin->ad_name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('list.course') }}">Course</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('add.studyplan') }}">Study Plan</a></li>
                        </ul>
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

        <div class="card report-card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="app-listing">
                            <li>
                                <div class="multipleSelection">
                                    <div class="selectBox">
                                        <p class="mb-0"><i class="fas fa-user-plus me-1 select-icon"></i> Select
                                            Department</p>
                                        <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form action="#">
                                            <p class="checkbox-title">Customer Search</p>
                                            <div class="form-custom">
                                                <input type="text" class="form-control bg-grey"
                                                    placeholder="Enter Customer Name">
                                            </div>
                                            <div class="selectBox-cont">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Brian Johnson
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
                                        <p class="mb-0"><i class="fas fa-calendar me-1 select-icon"></i> Select
                                            Specialization</p>
                                        <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form action="#">
                                            <p class="checkbox-title">Date Filter</p>
                                            <div class="selectBox-cont selectBox-cont-one h-auto">
                                                <div class="date-picker">
                                                    <div class="form-custom cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            placeholder="Form">
                                                    </div>
                                                </div>
                                                <div class="date-picker pe-0">
                                                    <div class="form-custom cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            placeholder="To">
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
                                        <p class="mb-0"><i class="fas fa-book-open me-1 select-icon"></i> Select Year &
                                            Semester</p>
                                        <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form action="#">
                                            <p class="checkbox-title">By Year & Semester</p>
                                            <div class="selectBox-cont">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name" checked>
                                                    <span class="checkmark"></span> All Courses
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 1 Semester 1
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 1 Semester 2
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 2 Semester 1
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 2 Semester 2
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 3 Semester 1
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 3 Semester 2
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 4 Semester 1
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="name">
                                                    <span class="checkmark"></span> Year 4 Semester 2
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
                                        <p class="mb-0"><i class="fas fa-bookmark me-1 select-icon"></i> Select Category
                                        </p>
                                        <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form action="#">
                                            <p class="checkbox-title">Category</p>
                                            <div class="form-custom">
                                                <input type="text" class="form-control bg-grey"
                                                    placeholder="Enter Category Name">
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




        <div class="card invoices-tabs-card border-0">
            <div class="card-body card-body pt-0 pb-0">
                <div class="invoices-main-tabs border-0 pb-0">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="invoices-settings-btn invoices-settings-btn-one">
                                <a href="invoices-settings.html" class="invoices-settings-icon">
                                    <i class="feather feather-settings"></i>
                                </a>
                                <a href="add-course" class="btn">
                                    <i class="feather feather-plus-circle"></i> New Course
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
                <div class="card invoices-grid-card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="view-invoice.html" class="invoice-grid-link">INFO1003</a>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="edit-invoice.html"><i
                                        class="far fa-edit me-2"></i>Edit</a>
                                <a class="dropdown-item" href="view-invoice.html"><i class="far fa-eye me-2"></i>View</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i
                                        class="far fa-trash-alt me-2"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-middle">
                        <h2 class="card-middle-avatar">
                            <a href="profile.html"> Elements of Programming</a>
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><i class="fas fa-users"></i> Total Students</span>
                                <h6 class="mb-0">150</h6>
                            </div>
                            <div class="col-auto">
                                <span><i class="fas fa-columns"></i> Number of Sections</span>
                                <h6 class="mb-0">5</h6>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="badge bg-success-dark">Open</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
                <div class="card invoices-grid-card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="view-invoice.html" class="invoice-grid-link">INFO1303</a>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="edit-invoice.html"><i
                                        class="far fa-edit me-2"></i>Edit</a>
                                <a class="dropdown-item" href="view-invoice.html"><i class="far fa-eye me-2"></i>View</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i
                                        class="far fa-trash-alt me-2"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-middle">
                        <h2 class="card-middle-avatar">
                            <a href="profile.html"> Object Oriented Programming</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><i class="far fa-money-bill-alt"></i> Total Students</span>
                                <h6 class="mb-0">132</h6>
                            </div>
                            <div class="col-auto">
                                <span><i class="far fa-calendar-alt"></i> Number of Sections</span>
                                <h6 class="mb-0">4</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="badge bg-success-dark">Open</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
                <div class="card invoices-grid-card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="view-invoice.html" class="invoice-grid-link">CSCI1003</a>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="edit-invoice.html"><i
                                        class="far fa-edit me-2"></i>Edit</a>
                                <a class="dropdown-item" href="view-invoice.html"><i class="far fa-eye me-2"></i>View</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i
                                        class="far fa-trash-alt me-2"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-middle">
                        <h2 class="card-middle-avatar">
                            <a href="profile.html">Introduction to Computer Organization</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span><i class="far fa-money-bill-alt"></i> Total Students</span>
                                <h6 class="mb-0">99</h6>
                            </div>
                            <div class="col-auto">
                                <span><i class="far fa-calendar-alt"></i> Number of Sections</span>
                                <h6 class="mb-0">3</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="badge bg-success-dark">Open</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

 

            <div class="col-lg-12">
                <div class="invoice-load-btn">
                    <a href="#" class="btn">
                        <span class="spinner-border text-primary"></span> Load more
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>



    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>


    <script src="assets/js/circle-progress.min.js"></script>

    <script src="assets/js/script.js"></script>
    </body>
@endsection
