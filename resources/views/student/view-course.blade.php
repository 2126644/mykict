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
    <div class="row align-items-center">
      <div class="col">
        <h3 class="page-title"><br>My Study Plan</h3>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card card-table">
        <div class="card-body">

          <div class="page-header">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="page-title">
                  Suggested Courses (Year {{ $nextYear }}, Sem {{ $nextSem }})
                </h3>
              </div>

              <div class="col-auto ms-auto download-grp">
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addOtherCoursesModal">
                <i class="bi bi-plus-circle"></i> Add Other Courses
              </button>
                <a href="{{ asset('assets/files/BCS-Study-Plan-Batch-241.pdf') }}"
                  class="btn btn-outline-primary me-2" download>
                  <i class="bi bi-download"></i>  BCS Study Plan 241
                </a>
                <a href="{{ asset('assets/files/BIT-Study-Plan-Batch-241.pdf') }}"
                  class="btn btn-outline-primary me-2" download>
                  <i class="bi bi-download"></i>  BIT Study Plan 241
                </a>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            @if($suggested->count())
            <form method="POST" action="{{ route('student.preferences.store') }}">
              @csrf

              <table class="table table-hover table-center mb-3 datatable table-striped">
                <thead class="student-thread">
                  <tr>
                    <th>Select</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
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
                  @foreach($suggested as $course)
                  <tr>
                    <td>
                      <input
                        type="checkbox"
                        name="course_codes[]"
                        value="{{ $course->course_code }}"
                        {{ in_array($course->course_code, $selectedCodes) ? 'checked' : '' }}>
                    </td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_title }}</td>
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

                  <!-- Where the newly selected courses from the modal will be inserted -->
                  <!-- Extra manually added (non-suggested) preferences -->
                  @foreach ($selected as $course)
                  @if (!in_array($course->course_code, $suggested->pluck('course_code')->toArray()))
                  <tr style="background-color: #f4fcf9;" data-extra="{{ $course->course_code }}">
                    <td>
                      <input type="checkbox" name="course_codes[]" value="{{ $course->course_code }}" checked>
                    </td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->course_title }}</td>
                    <td>{{ $course->credit_hrs }}</td>        
                    <!-- $course = the Preference  $course->course = the related Course model -->
                    <td>{{ $course->course->pre_requisites ?? '-' }}</td>
                    <td>{{ $course->course->year ?? '-' }}</td>
                    <td>{{ $course->course->sem ?? '-' }}</td>
                    <td>{{ $course->course->category ?? '-' }}</td>
                    <td>{{ $course->course->department ?? '-' }}</td>
                    <td>{{ $course->course->specialization ?? '-' }}</td>
                    <td>{{ $course->course->programme ?? '-' }}</td>
                  </tr>
                  @endif
                  @endforeach
                  <!-- Placeholder for JS-added rows -->
                  <tr id="extra-courses-placeholder"></tr>
                </tbody>
              </table>

              <button type="submit" class="btn btn-primary">Save Study Plan</button>
            </form>
            @else
            <div class="alert alert-warning text-center">
              No suggested courses found.
            </div>
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Add Other Courses Modal -->
  <div class="modal fade" id="addOtherCoursesModal" tabindex="-1" aria-labelledby="addOtherCoursesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addOtherCoursesLabel">Add Other Courses</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Select</th>
                <th>Course Code</th>
                <th>Course Title</th>
              </tr>
            </thead>
            <tbody>
              @foreach($all_courses as $course)
              <tr>
                <td>
                  <input type="checkbox" class="extra-course" value="{{ $course->course_code }}" data-title="{{ $course->course_title }}">
                </td>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->course_title }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="addSelectedCourses">Add Selected</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript to append selected courses -->
  <script>
    document.getElementById('addSelectedCourses').addEventListener('click', function() {
      let selected = document.querySelectorAll('.extra-course:checked');
      selected.forEach(input => {
        let code = input.value;
        let title = input.dataset.title;

        // Check if already added
        if (!document.querySelector(`[data-extra="${code}"]`)) {
          let row = `
                <tr data-extra="${code}">
                    <td><input type="checkbox" name="course_codes[]" value="${code}" checked></td>
                    <td>${code}</td>
                    <td>${title}</td>
                    <td colspan="8">Added manually</td>
                </tr>
            `;
          document.querySelector('#extra-courses-placeholder').insertAdjacentHTML('beforebegin', row);
        }
      });

      // Close modal
      var modal = bootstrap.Modal.getInstance(document.getElementById('addOtherCoursesModal'));
      modal.hide();
    });
  </script>

  <script>
    function saveSubjectDetails() {
      // Logic for saving subject details can go here.
      alert("Subject details saved!");
      // Perform backend actions to save the data (e.g., AJAX or form submission).
    }
  </script>

  <script async type='module' src='https://interfaces.zapier.com/assets/web-components/zapier-interfaces/zapier-interfaces.esm.js'></script>
  <zapier-interfaces-chatbot-embed is-popup='true' chatbot-id='cmb8x30m4002qwowpp0bbi4k2'></zapier-interfaces-chatbot-embed>

  @endsection

