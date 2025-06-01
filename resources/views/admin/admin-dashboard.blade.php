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

{{-- style for dashboard --}}
<style>
    /* Ensure Poppins font is loaded and used */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body,
    * {
        font-family: 'Poppins', sans-serif !important;
    }

    .dashboard-cards .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        transition: all 0.3s ease;
        height: 180px;
        /* Consistent height */
    }

    .dashboard-cards .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .dashboard-cards .card-body {
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .dashboard-icon {
        background-color: rgba(0, 123, 255, 0.1);
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }

    .dashboard-icon {
        width: 60px;
        height: 60px;
        font-size: 1.75rem;
        /* Makes the <i> icon about 28px */
    }

    .dashboard-info h6 {
        font-size: 0.85rem;
        text-transform: uppercase;
        color: #2980b9;
        margin-bottom: 0.25rem;
    }

    .dashboard-info h3 {
        font-size: 1.25rem;
        margin: 0;
    }
</style>

<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title"><br>Welcome, <strong>{{ $admin->ad_name }}</strong>!</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    <div class="col-xl-4 col-md-6 col-12">
            <div class="card border-secondary h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center me-3">
                        <i class="bi bi-credit-card" style="font-size:1.75rem;"></i>
                    </div>
                    <div class="dashboard-info">
                        <h6>Admin ID</h6>
                        <h3>{{ $admin->admin_id }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <div class="card border-secondary h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center me-3">
                        <i class="bi bi-person-circle" style="font-size:1.75rem;"></i>
                    </div>
                    <div class="dashboard-info">
                        <h6>Admin Name</h6>
                        <h3>{{ $admin->ad_name }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 col-12">
            <div class="card border-secondary h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="dashboard-icon bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center me-3">
                        <i class="bi bi-envelope" style="font-size:1.75rem;"></i>
                    </div>
                    <div class="dashboard-info">
                        <h6>Admin Email</h6>
                        <h3>{{ $admin->ad_email }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title">Course Popularity</h5>
                </div>
                <div class="card-body">
                    <div id="coursePopularity"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title">Gender by Year/Semester</h5>
                </div>
                <div class="card-body">
                    <div id="genderSemChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title">Monthly Sign-Ups</h5>
                </div>
                <div class="card-body">
                    <div id="signupTrend"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title">Departmental Demand</h5>
                </div>
                <div class="card-body">
                    <div id="deptPie"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.20/c3.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.16.0/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.20/c3.min.js"></script>

@push('scripts')
<!-- ApexCharts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // 1) Course Popularity Bar Chart
        new ApexCharts(
            document.querySelector('#coursePopularity'), {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Selections',
                    data: @json($popularCounts)
                }],
                xaxis: {
                    categories: @json($popularLabels),
                    title: {
                        text: 'Course Code'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Number of Times Chosen'
                    }
                },
                colors: ['#20c997'],
                plotOptions: {
                    bar: {
                        borderRadius: 4
                    }
                }
            }
        ).render();


        // 5) Gender by Year/Semester Column Chart (#s-col)
        if ($('#genderSemChart').length > 0) {
            var genderSem = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                        name: 'Male',
                        data: @json($genderBySemMale)
                    },
                    {
                        name: 'Female',
                        data: @json($genderBySemFemale)
                    }
                ],
                xaxis: {
                    categories: @json($enrollLabels)
                },
                yaxis: {
                    title: {
                        text: 'Total Students'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val;
                        }
                    }
                },
                colors: ['#1E90FF', '#FF69B4']
            };
            new ApexCharts(
                document.querySelector('#genderSemChart'),
                genderSem
            ).render();


            if ($('#signupTrend').length > 0) {
                var signupLine = {
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    series: [{
                        name: 'New Sign-Ups',
                        data: @json($signupCounts)
                    }],
                    title: {
                        text: 'Monthly New Student Sign-Ups',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f1f2f3', 'transparent'],
                            opacity: 0.5
                        }
                    },
                    xaxis: {
                        categories: @json($signupLabels),
                        title: {
                            text: 'Month (YYYY-MM)'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Sign-Ups'
                        }
                    },
                    markers: {
                        size: 4
                    },
                    colors: ['#28a745'],
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    }
                };
                var chart = new ApexCharts(
                    document.querySelector('#signupTrend'),
                    signupLine
                );
                chart.render();
            };

            // 6) Departmental Demand Treemap
            // prepare your PHP‐generated data
            var deptData = @json($treemapData);
            // convert to C3 columns: [ ['Dept1', 5], ['Dept2', 3], … ]
            var columns = deptData.map(function(d) {
                return [d.x, d.y];
            });
            // optional: assign each department a color (you can customize this)
            var colors = {};
            var palette = ['#664dc9', '#44c4fa', '#2dce89', '#ff5b51', '#fbbc04', '#ea4335'];
            deptData.forEach(function(d, i) {
                colors[d.x] = palette[i % palette.length];
            });
            // optional: give friendly names (here same as the key)
            var names = {};
            deptData.forEach(function(d) {
                names[d.x] = d.x;
            });

            // generate the pie chart with legend enabled
            var chart = c3.generate({
                bindto: '#deptPie',
                data: {
                    columns: columns,
                    type: 'pie',
                    colors: colors,
                    names: names
                },
                legend: {
                    show: true, // enable the legend
                    position: 'right' // you can also use 'bottom', 'inset', etc.
                },
                padding: {
                    bottom: 0,
                    top: 0
                }
            });
        }

    });
</script>
@endpush

@endsection
