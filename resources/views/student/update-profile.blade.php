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

                    <form action="{{ route('student.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-2">Name</label>
                            <div class="col-md-5">
                                <input type="text" name="st_name" class="form-control @error('st_name') is-invalid @enderror" value="{{ old('st_name', $student->st_name) }}" required>
                                @error('st_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-2">Matric Number</label>
                            <div class="col-md-5">
                                <input type="text" name="matric_no" class="form-control" value="{{ $student->matric_no }}" readonly>
                            </div>
                        </div>

                        
        <div class="form-group row mb-3">
            <label for="programme" class="col-form-label col-md-2">Programme</label>
            <div class="col-md-5">
                <select name="programme" id="programme" class="form-control form-select" required>
                    <option value="">-- Select Programme --</option>
                    @foreach($programmes as $prgm)
                        <option value="{{ $prgm }}" {{ old('programme', $student->programme) === $prgm ? 'selected' : '' }}>
                            {{ $prgm }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="specialization" class="col-form-label col-md-2">Specialization</label>
            <div class="col-md-5">
                <select name="specialization" id="specialization" class="form-control form-select">
                    <option value="">-- Select Specialization --</option>
                    @if(old('programme', $student->programme))
                        {{-- If we already have a selected programme, pre‐load those options --}}
                        @php
                            $preloadedSpecs = \App\Models\Course::where('programme', old('programme', $student->programme))
                                        ->distinct()
                                        ->pluck('specialization');
                        @endphp

                        @foreach($preloadedSpecs as $spec)
                            <option value="{{ $spec }}" {{ old('specialization', $student->specialization) === $spec ? 'selected' : '' }}>
                                {{ $spec }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
                        <div class="form-group row mb-3">
                            <label class="col-form-label col-md-2">Year</label>
                            <div class="col-md-10 d-flex">
                                @for ($y = 1; $y <= 4; $y++)
                                    <div class="form-check me-3">
                                    <input class="form-check-input @error('year') is-invalid @enderror" type="radio" name="year" id="year{{ $y }}" value="{{ $y }}" required
                                        {{ $student->year == $y ? 'checked' : '' }}>
                                    <label class="form-check-label" for="year{{ $y }}">
                                        Year {{ $y }}
                                    </label>
                            </div>
                            @endfor
                            @error('year')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-2">Semester</label>
                    <div class="col-md-5">
                        <select name="sem" class="form-control form-select @error('sem') is-invalid @enderror" required>
                            <option value="">-- Select Semester --</option>
                            @for ($s = 1; $s <= 2; $s++)
                                <option value="{{ $s }}" {{ $student->sem == $s ? 'selected' : '' }}>Sem {{ $s }}</option>
                                @endfor
                        </select>
                        @error('sem')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-2">Current CGPA</label>
                    <div class="col-md-5">
                        <input type="number" step="0.01" min="0" max="4.00" name="current_cgpa" class="form-control @error('current_cgpa') is-invalid @enderror" 
                            value="{{ old('current_cgpa', $student->current_cgpa) }}"
                            placeholder="Enter your current CGPA">
                            @error('current_cgpa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-form-label col-md-2">Target CGPA</label>
                    <div class="col-md-5">
                        <input type="number" step="0.01" min="0" max="4.00" name="target_cgpa" class="form-control @error('target_cgpa') is-invalid @enderror" 
                        value="{{ old('target_cgpa', $student->target_cgpa) }}" 
                            placeholder="Enter your target CGPA" >
                            @error('target_cgpa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label col-md-2">GPA & CGPA Results (Semester 1 - 8)</label>
                    <div class="col-md-10">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Semester</th>
                                    <th>GPA</th>
                                    <th>CGPA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 8; $i++)
                                    <tr>
                                    <td class="align-middle">Semester {{ $i }}</td>
                                    <td>
                                        <input type="number" step="0.01" min="0" max="4.00" name="gpa_sem{{ $i }}" class="form-control @error('gpa_sem'.$i) is-invalid @enderror"
                                            value="{{ old('gpa_sem' . $i, $student->{'gpa_sem' . $i}) }}"
                                            placeholder="Enter GPA">
                                            @error('gpa_sem'.$i)
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" max="4.00" name="cgpa_sem{{ $i }}" class="form-control @error('cgpa_sem'.$i) is-invalid @enderror"
                                            value="{{ old('cgpa_sem' . $i, $student->{'cgpa_sem' . $i}) }}"
                                            placeholder="Enter CGPA">
                                            @error('cgpa_sem'.$i)
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                    </td>
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

</div>



@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grab references to the two dropdowns
        const programmeSelect      = document.getElementById('programme');
        const specializationSelect = document.getElementById('specialization');

        programmeSelect.addEventListener('change', function() {
            const selectedProgramme = this.value;

            // Clear out any existing options in the specialization dropdown
            specializationSelect.innerHTML = '<option value="">-- Select Specialization --</option>';

            if (! selectedProgramme) {
                // If user resets Programme to “”, we leave Specialization blank
                return;
            }

            // Fetch the specializations via AJAX
            fetch(`/ajax/specializations/${encodeURIComponent(selectedProgramme)}`)
                .then(response => response.json())
                .then(data => {
                    // data is an array of specialization strings, e.g. ['Info Assurance', 'Data Science', …]
                    data.forEach(spec => {
                        const option = document.createElement('option');
                        option.value = spec;
                        option.textContent = spec;
                        specializationSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    // In a real app, you might show an error or fallback
                    console.error('Failed to fetch specializations.');
                });
        });
    });
</script>
@endpush

@endsection
