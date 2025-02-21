@extends('layouts.backend.admin')
@section('content')
<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">

                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Divisions</p>
                                <h4 class="my-1 text-info">66</h4>
                                <!-- <p class="mb-0 font-13">+2.5% from last week</p> -->
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-business'></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Users</p>
                        <h4 class="my-1 text-danger">{{ $totalUsers }}</h4>
                    </div>
                        <!-- <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                        </div> -->
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Documents Submitted</p>
                            <h4 class="my-1 text-success">25</h4>
                            <!-- <p class="mb-0 font-13">-4.5% from last week</p> -->
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-file'></i>

                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Designation</p>
                            <h4 class="my-1 text-warning">41</h4>
                            <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
                        </div>
                        <div class="widgets-icons-2 rounded-circle text-white ms-auto" style="background:rgb(175, 76, 170);">
                         <i class='bx bxs-user-badge'></i></div>

                    </div>
                </div>
                </div>
            </div>
            </div><!--end row-->

            <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0"> Annual Visitor Report for {{date('Y')}} </h6>
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
                        {{-- <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span>
                        </div> --}}
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                        <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">24.15M</h5>
                            <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
                        </div>
                        </div>
                        <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">12:38</h5>
                            <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
                        </div>
                        </div>
                        <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">639.82</h5>
                            <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
                        </div>
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
                type: 'pie2d',
                renderAt: 'chart-container',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Documents Type",
                        "numberPrefix": "$",
                        "showPercentInTooltip": "1",
                        "decimals": "1",
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
