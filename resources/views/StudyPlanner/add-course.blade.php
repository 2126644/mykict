@extends('layouts.master')

@section('content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
        <div class="row align">
                <div class="col">
                    <h3 class="page-title">Course</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.welcome') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminSSP.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Course</li>
                        <li class="breadcrumb-item"><a href="{{ route('add.studyplan') }}">Study Plan</a></li>

                    </ul>
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
                        <form action="{{ route('add.course') }}" method="POST">
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
                                    <option value="Kulliyyah Required Course">Kulliyyah Required Course</option>
                                    <option value="Department Required Course">Department Required Course</option>
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

                        <!-- Specialization -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Specialization</label>
                            <div class="col-md-10">
                                <select name="specialization" class="form-control form-select">
                                    <option value="" disabled selected>-- BIT --</option>
                                    <option value="Digital Media Design">Digital Media Design</option>
                                    <option value="Business Intelligence & Information Science">Business Intelligence & Information Science</option>
                                    <option value="Information Assurance & Security">Information Assurance & Security</option>
                                    <option value="Enterprise Technology Management">Enterprise Technology Management</option>
                                    <option value="Digitalpreneurship">Digitalpreneurship</option>
                                    <option value="" disabled selected>-- BCS --</option>
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="Data Science & Computational Intelligence">Data Science & Computational Intelligence</option>
                                    <option value="Network & Security">Network & Security</option>
                                    <option value="Free/ No Specialization">Free/ No Specialization</option>
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
                                    <option value="3">3</option>
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
