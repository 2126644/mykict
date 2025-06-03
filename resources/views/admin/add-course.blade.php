@extends('layouts.master')

@section('content')

{{-- style for background --}}
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

        <!-- Page Header -->
        <div class="page-header">
        <div class="row align">
                <div class="col">
                    <h3 class="page-title"><br>Add New Course</h3>
                </div>
            </div>
        </div>

        <!-- Add Course Form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Course</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.course.store') }}" method="POST">
                        @csrf

                        <!-- Course Code -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Course Code</label>
                            <div class="col-md-10">
                                <input type="text" name="course_code" class="form-control" required>
                            </div>
                        </div>

                        <!-- Course Title -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Course Title</label>
                            <div class="col-md-10">
                                <input type="text" name="course_title" class="form-control" required>
                            </div>
                        </div>

                        <!-- Credit Hour -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Credit Hour</label>
                            <div class="col-md-10">
                                <select name="credit_hrs" class="form-control form-select" required>
                                    <option value="" disabled selected>-- Select --</option>
                                    <option value="0.5">0.5</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pre-Requisite -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Pre-Requisite</label>
                            <div class="col-md-10">
                                <input type="text" name="pre_requisites" class="form-control">
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Category</label>
                            <div class="col-md-10">
                                <select name="category" class="form-control form-select" required>
                                    <option value="" disabled selected>-- Select --</option>
                                    <option value="University Required Courses">University Required Courses</option>
                                    <option value="Core Computing Courses">Core Computing Courses</option>
                                    <option value="Discipline Core Courses">Discipline Core Courses</option>
                                    <option value="Field Electives">Field Electives</option>
                                    <option value="Final Year Project (1&2)">Final Year Project (1&2)</option>
                                    <option value="Industrial Attachment">Industrial Attachment</option>

                                </select>
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Department</label>
                            <div class="col-md-10">
                                <select name="department" class="form-control form-select" required>
                                    <option value="" disabled selected>-- Select --</option>
                                    <option value="Information Systems">Information Systems</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Library & Information Science">Library & Information Science</option>
                                </select>
                            </div>
                        </div>

                        <!-- Field Electives -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Field Electives</label>
                            <div class="col-md-10">
                                <select name="specialization" class="form-control form-select">
                                    <option value="" disabled selected>-- BIT --</option>
                                    <option value="Cybersecurity">Cybersecurity</option>
                                    <option value="Cloud Computing & System Paradigm">Cloud Computing & System Paradigm</option>
                                    <option value="Innovative Digital Experience (IDEx)">Innovative Digital Experience (IDEx)</option>
                                    <option value="Data Analytics">Data Analytics</option>
                                    <option value="Digital Transformation">Digital Transformation</option>
                                    <option value="" disabled selected>-- BCS --</option>
                                    <option value="Application Development Engineering">Application Development Engineering</option>
                                    <option value="Artificial Intelligence">Artificial Intelligence</option>
                                    <option value="Security in Digital System">Security in Digital System</option>
                                    <option value="Data Engineering">Data Engineering</option>
                                    <option value="Network & Data Communications">Network & Data Communications</option>
                                </select>
                            </div>
                        </div>

                        <!-- Year -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Year</label>
                            <div class="col-md-10">
                                <select name="year" class="form-control form-select" required>
                                    <option value="" disabled selected>-- Select --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Semester -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Semester</label>
                            <div class="col-md-10">
                                <select name="sem" class="form-control form-select" required>
                                    <option value="" disabled selected>-- Select --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="form-group row">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
