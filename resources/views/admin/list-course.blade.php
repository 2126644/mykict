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
    .page-title {
        font-size: 2rem;
        font-weight: bold;
        color: #2980b9;
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
        <div class="row align">
            <div class="col">
                <h3 class="page-title">Courses</h3>
            </div>
        </div>
    </div>

    <div class="card report-card">
        <div class="card-body pb-0">

            <!-- Search and Filter Form -->
            <form action="{{ route('admin.courses') }}" method="GET" class="row g-3 align-items-end">

                <div class="col-md-3">
                    <input type="text" name="course_code" class="form-control" placeholder="Search by Course Code ..." value="{{ request('course_code') }}">
                </div>

                <div class="col-md-3">
                    <input type="text" name="course_title" class="form-control" placeholder="Search by Course Title ..." value="{{ request('course_title') }}">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>

                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.course.add') }}" class="btn btn-primary">
                        <i class="feather feather-plus-circle"></i> Add Course
                    </a>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Select Department</label>
                    <select name="department" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($departments as $dept)
                        <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Select Specialization</label>
                    <select name="specialization" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($specializations as $spec)
                        <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Select Year</label>
                    <select name="year" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Select Category</label>
                    <select name="category" class="form-select">
                        <option value="">-- All --</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                        <label for="programme" class="form-label">Select Programme</label>
                        <select name="programme" id="programme" class="form-select">
                            <option value="">-- All --</option>
                            @foreach ($programmes as $prgm)
                            <option value="{{ $prgm }}" {{ request('programme') == $prgm ? 'selected' : '' }}>
                                {{ $prgm }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                <div class="col-12 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <a href="{{ route('admin.courses') }}" class="btn btn-secondary">Reset</a>
                </div>

            </form>

            <!-- Course Table -->
            <form id="bulkDeleteForm" action="{{ route('admin.courses.bulkDelete') }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')

                <div class="table-responsive">
                    @if($courses->count() > 0)
                    <table class="table border-0 table-hover table-center datatable table-striped">
                        <thead class="student-thread">
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Total Students</th>
                                <th>Credit Hour</th>
                                <th>Pre-Requisite</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Category</th>
                                <th>Department</th>
                                <th>Specialization</th>
                                <th>Programme</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td><input type="checkbox" name="course_codes[]" value="{{ $course->course_code }}"></td>
                                <td>
                                    <a href="{{ route('admin.course.edit', $course->course_code) }}" class="text-primary text-decoration-underline">
                                        {{ $course->course_code }}
                                    </a>
                                </td>
                                <td>{{ $course->course_title }}</td>
                                <td>{{ $course->total_students }}</td>
                                <td>{{ $course->credit_hrs }}</td>
                                <td>{{ $course->pre_requisites }}</td>
                                <td>{{ $course->year }}</td>
                                <td>{{ $course->sem }}</td>
                                <td>{{ $course->category }}</td>
                                <td>{{ $course->department }}</td>
                                <td>{{ $course->specialization }}</td>
                                <td>{{ $course->programme }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-danger mt-3">Delete Selected</button>
                    @else
                    <div class="alert alert-warning text-center mt-3">
                        No courses found.
                    </div>
                    @endif
                </div>
            </form>

        </div>
    </div>

</div>

<!-- Scripts -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="course_codes[]"]');

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
            });
        }
    });
</script>
@endpush

@endsection
