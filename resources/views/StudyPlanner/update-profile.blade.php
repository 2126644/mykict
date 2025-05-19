@extends('layouts.master')

@section('content')
        <div class="content container-fluid">
            <div class="page-header">
                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                @endif
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">My Profile</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Update Profile</h5>
                        </div>
                        <div class="card-body">

                         {{-- <form action="#" method="GET">

                            <div class="form-group row">
                                        <label class="col-form-label col-md-2">Name</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name"
                                                value="Nur Ain binti Lizam">
                                        </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Matric Number</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="matric_number" value="2127942"
                                            readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Programme</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="programme" placeholder="BIT / BCS">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Specialization</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="specialization">
                                            <option>-- Select --</option>
                                            <option>Information Assurance and Security</option>
                                            <option>Business Intelligence and Information Science</option>
                                            <option>Digital Media Design</option>
                                            <option>Enterprise Technology Management</option>
                                        </select>
                                    </div>
                                </div>

                                     <div class="form-group row">
                                    <label class="col-form-label col-md-2">Year</label>
                                    <div class="col-md-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="year" value= "1"> Year 1
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="year" value="2"> Year 2
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="year" value="3"> Year 3
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="year" value="4"> Year 4
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Semester</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="semester">
                                            <option>-- Select --</option>
                                            <option>Sem 1</option>
                                            <option>Sem 2</option>
                                            <option>Sem 3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Current CGPA</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="current_cgpa"
                                            placeholder="Enter your current CGPA" step="0.01" min="0"
                                            max="4.00">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Target CGPA</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="target_cgpa"
                                            placeholder="Enter your target CGPA" step="0.01" min="0"
                                            max="4.00">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">GPA & CGPA Results (Semester 1 - 8)</label>
                                    <div class="col-md-10">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Semester</th>
                                                    <th>GPA</th>
                                                    <th>CGPA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 1; $i <= 8; $i++)
                                                    <tr>
                                                        <td>Semester {{ $i }}</td>
                                                        <td><input type="number" class="form-control"
                                                                name="gpa_semester_{{ $i }}"
                                                                placeholder="Enter GPA" step="0.01" min="0"
                                                                max="4.00"></td>
                                                        <td><input type="number" class="form-control"
                                                                name="cgpa_semester_{{ $i }}"
                                                                placeholder="Enter CGPA" step="0.01" min="0"
                                                                max="4.00"></td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div> --}}

                            {{-- START SINIIIII --}}
                            <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Name</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="st_name"
                                                value="{{ $student->st_name }}">
                                        </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Matric Number</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="matric_no" value="{{ $student->matric_no }}"
                                            readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Programme</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="major" value="{{ $student->major }}">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Specialization</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="specialization">
                                                <option value="">-- Select --</option>
                                                <option {{ $student->specialization == 'Information Assurance and Security' ? 'selected' : '' }}>
                                                    Information Assurance and Security
                                                </option>
                                                <option {{ $student->specialization == 'Business Intelligence and Information Science' ? 'selected' : '' }}>
                                                    Business Intelligence and Information Science
                                                </option>
                                                <option {{ $student->specialization == 'Digital Media Design' ? 'selected' : '' }}>
                                                    Digital Media Design
                                                </option>
                                                <option {{ $student->specialization == 'Enterprise Technology Management' ? 'selected' : '' }}>
                                                    Enterprise Technology Management
                                                </option>
                                            </select>
                                    </div>
                                </div>

                                <label class="col-form-label col-md-2">Year</label>
                                <div class="col-md-10">
                                    @for ($y = 1; $y <= 4; $y++)
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="year" value="{{ $y }}"
                                                    {{ $student->year == $y ? 'checked' : '' }}>
                                                Year {{ $y }}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Semester</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="sem">
                                        <option value="">-- Select --</option>
                                        @for ($s = 1; $s <= 8; $s++)
                                            <option value="{{ $s }}" {{ $student->sem == $s ? 'selected' : '' }}>Sem {{ $s }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Current CGPA</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="current_cgpa"
                                        value="{{ $student->current_cgpa }}"
                                        placeholder="Enter your current CGPA" step="0.01" min="0" max="4.00">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Target CGPA</label>
                                <div class="col-md-10">
                                    <input type="number" class="form-control" name="target_cgpa"
                                        value="{{ $student->target_cgpa }}"
                                        placeholder="Enter your target CGPA" step="0.01" min="0" max="4.00">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">GPA & CGPA Results (Semester 1 - 8)</label>
                                <div class="col-md-10">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Semester</th>
                                                <th>GPA</th>
                                                <th>CGPA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= 8; $i++)
                                                <tr>
                                                    <td>Semester {{ $i }}</td>
                                                    <td>
                                                        <input type="number" class="form-control"
                                                            name="gpa_sem{{ $i }}"
                                                            value="{{ old('gpa_sem' . $i, $student->{'gpa_sem' . $i}) }}"
                                                            placeholder="Enter GPA" step="0.01" min="0" max="4.00">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control"
                                                            name="cgpa_sem{{ $i }}"
                                                            value="{{ old('cgpa_sem' . $i, $student->{'cgpa_sem' . $i}) }}"
                                                            placeholder="Enter CGPA" step="0.01" min="0" max="4.00">
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

@endsection
