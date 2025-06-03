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

    <div class="content container-fluid">
        <div class="page-header">

            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title"><br>Edit Course</h3>
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
    @endsection
