@extends('layouts.master')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Edit Course</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.course.update', $course->course_code) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Course Information</span></h5>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Course Code <span class="login-danger">*</span></label>
                                        <input type="text" name="course_code" class="form-control" value="{{ $course->course_code }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Course Title <span class="login-danger">*</span></label>
                                        <input type="text" name="course_title" class="form-control" value="{{ $course->course_title }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group local-forms">
                                        <label>Credit Hour <span class="login-danger">*</span></label>
                                        <input type="text" name="credit_hrs" class="form-control" value="{{ $course->credit_hrs }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Department <span class="login-danger">*</span></label>
                                        <input type="text" name="department" class="form-control" value="{{ $course->department }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Specialization</label>
                                        <input type="text" name="specialization" class="form-control" value="{{ $course->specialization }}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Category</label>
                                        <input type="text" name="category" class="form-control" value="{{ $course->category }}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Pre-requisites</label>
                                        <input type="text" name="pre_requisites" class="form-control" value="{{ $course->pre_requisites }}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Year <span class="login-danger">*</span></label>
                                        <input type="number" name="year" class="form-control" value="{{ $course->year }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Semester <span class="login-danger">*</span></label>
                                        <input type="number" name="sem" class="form-control" value="{{ $course->sem }}" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="course-submit">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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

<script src="assets/js/script.js"></script>
</body>

</html>