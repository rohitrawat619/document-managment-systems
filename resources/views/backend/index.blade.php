@php
use Illuminate\Support\Facades\Session;
@endphp

@extends('layouts.backend.admin')
@section('content')
<style>

    </style>
<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-md-3 g-3">
          <div class="col">
            <div class="card d-flex flex-column radius-10 border-start border-0 border-5 border-info" style="min-height: 60px;">
                <div class="card-body d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 text-secondary" style="font-size: 12px;">Total Divisions</p>
                        <h4 class="my-1 text-info" style="font-size: 16px;">{{ $totaldivision }}</h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class='bx bxs-business'></i>
                    </div>
                </div>
            </div>
        </div>
            <div class="col">
                <div class="card d-flex flex-column radius-10 border-start border-0 border-5 border-danger" style="min-height: 60px;">
                    <div class="card-body d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 text-secondary" style="font-size: 12px;">Total Users</p>
                            <h4 class="my-1 text-danger" style="font-size: 16px;">{{ $totalUsers }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
            <div class="card d-flex flex-column radius-10 border-start border-0 border-5 border-success" style="min-height: 60px;">
                <div class="card-body d-flex flex-row justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 text-secondary" style="font-size: 12px;">Documents Submitted</p>
                        <h4 class="my-1 text-success" style="font-size: 16px;">{{ $totalForms }}</h4>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class='bx bxs-file'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

          </div>
            <!--end row-->
<div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-body">

                            <div id="chart-container">FusionCharts XT will load here!</div>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </div>

                    </div>
                </div>

             <!-- end row  -->

             <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">User Status</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Active Users <span class="badge bg-success rounded-pill">1</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">User in Trash <span class="badge bg-danger rounded-pill">2</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">In-active Users <span class="badge bg-primary rounded-pill">4</span>
                        </li>

                    </ul>
                </div>
            </div>
            </div>
    </div>
<!--end page wrapper -->
@push('scripts')
    <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/chartjs/js/chart.js')}}"></script>
    <script src="{{asset('backend/assets/js/index.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metismenu/3.0.7/metisMenu.min.js"></script>

    <script>

document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("chart2");
    if (ctx) {
        var myChart = new Chart(ctx.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: ["Active Users", "User in Trash", "Inactive Users"],
                datasets: [{
                    data: [1, 2, 4],
                    backgroundColor: ["#28a745", "#dc3545", "#007bff"],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: "bottom"
                    }
                }
            }
        });
    } else {
        console.error("Canvas element not found! Check the ID.");
    }
});


        console.log(window.Chart);

        if($('body').hasClass('app-container'))
        {
            new PerfectScrollbar(".app-container")
        }
	</script>

<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
$(document).ready(function(){
    //alert("hyyy");
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(document).ready(function(){
    $.ajax({
        url: '/report-counts',
        method: 'POST',
        dataType: 'json',
        success: function(data) {
            console.log("Data received:", data);
            var chartObj = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '100%',
                height: '100%',
                dataFormat: 'json',
                dataSource: {
                   "chart": {
                    "caption": "Documents Type",
                    "xAxisName": "Document Type",
                    "yAxisName": "Total",
                    "xAxisNameFontBold": "1",
                    "yAxisNameFontBold": "1",
                    "xAxisNameFontSize": "16",
                    "yAxisNameFontSize": "16",
                    "xAxisNameFontColor": "#000000",
                    "yAxisNameFontColor": "#000000",
                    "baseFont": "Arial",
                    "baseFontBold": "1",
                    "theme": "fusion"
                },
                    "data": data
                }
            });
            chartObj.render();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
});

  });


    </script>
@endpush
@endsection
