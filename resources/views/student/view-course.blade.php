@extends('layouts.master')

@section('content')

<!-- Head section -->
{{-- <head>
    <link rel="stylesheet" href="assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="assets/plugins/icons/feather/feather.css">
</head> --}}
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
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Course</h3>
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
              <a href="{{ asset('assets/files/BCS-Study-Plan-Batch-241.pdf') }}"
                 class="btn btn-outline-primary me-2" download>
                <i class="fas fa-download"></i> BCS Study Plan 241
              </a>
              <a href="{{ asset('assets/files/BIT-Study-Plan-Batch-241.pdf') }}"
                 class="btn btn-outline-primary me-2" download>
                <i class="fas fa-download"></i> BIT Study Plan 241
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
                          {{ in_array($course->course_code, $selectedCodes) ? 'checked' : '' }}
                        >
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
                </tbody>
              </table>

              <h4>Add Other Courses</h4>
              <select name="extra_codes[]" multiple class="form-select mb-3">
                @foreach($all_courses as $course)
                  <option value="{{ $course->course_code }}">
                    {{ $course->course_code }} – {{ $course->course_title }}
                  </option>
                @endforeach
              </select>

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


    <!-- Modal for Save Confirmation -->
    <div class="modal custom-modal fade" id="save_invocies_details" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Save Subject Details</h3>
                        <p>Are you sure you want to save?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Save</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/script.js"></script> --}}

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
