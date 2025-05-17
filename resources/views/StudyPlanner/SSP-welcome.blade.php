@extends('layouts.master')

@section('content')
<div class="content container-fluid d-flex align-items-center justify-content-center" style="height: 100vh; background: url('{{ asset('assets/img/background-kict2.jpg') }}') no-repeat center center/cover;">

    <div class="page-header text-center" style="color: #fff;">
        <h3 class="page-title" style="
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8), 4px 4px 10px rgba(0, 0, 0, 0.6);
            background: linear-gradient(45deg, #000000, #000000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: solid;
        ">
            Smart Study Planner
        </h3>
        <ul class="breadcrumb justify-content-center" style="list-style: none; padding: 0; margin-top: 20px;">
            <li class="breadcrumb-item">
                <a href="dashboard" style="color: #ffffff; text-decoration: none;">Home</a>
            </li>
            <li class="breadcrumb-item active" style="color: #ffffff;">Study Planner</li>
        </ul>


        <!-- Add Buttons -->
        <div style="margin-top: 15px;">
            <a href="{{ route('SSP.dashboard') }}" class="btn btn-primary btn-lg" style="margin-bottom: 10px;">STUDENT DASHBOARD</a>
        </div>

        <div style="margin-top: 15px;">
            <a href="{{ route('view.course') }}" class="btn btn-primary btn-lg" style="margin-bottom: 10px;">VIEW SUGGESTED COURSE</a>
        </div>

        <div style="margin-top: 15px;">
            <a href="{{ route('cgpa.calculator') }}" class="btn btn-primary btn-lg" style="margin-bottom: 10px;">CGPA CALCULATOR AND FORECASTER</a>
        </div>

    </div>
</div>
@endsection
