@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1><br>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Media Summary</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Audio Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Audio Files <span>| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-music-note-beamed"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $audioCount }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Audio Card -->

                    <!-- Video Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Video Files <span>| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-camera-reels"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $videoCount }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Video Card -->

                    <!-- Image Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card customers-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Image Files <span>| Total</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $imageCount }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Available</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Image Card -->

                    <!-- Donut Chart -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Files Uploaded <span>| Last 12 Hours</span></h5>
                                <div id="donutChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#donutChart"), {
                                            series: @json($donutChartData),
                                            chart: {
                                                type: 'donut',
                                                height: 350,
                                                toolbar: { show: false },
                                            },
                                            labels: @json($donutChartLabels),
                                            colors: ['#FFD700', '#1E90FF', '#32CD32'],
                                            tooltip: {
                                                y: {
                                                    formatter: function(val) {
                                                        return val + " files";
                                                    }
                                                }
                                            },
                                            stroke: { width: 5, colors: ['#fff'] },
                                            fill: {
                                                type: 'gradient',
                                                gradient: {
                                                    shade: 'dark',
                                                    type: 'vertical',
                                                    gradientToColors: ['#FFD700', '#1E90FF', '#32CD32'],
                                                    stops: [0, 100]
                                                }
                                            },
                                            dropShadow: {
                                                enabled: true,
                                                top: 5,
                                                left: 2,
                                                blur: 3,
                                                color: '#000',
                                                opacity: 0.3
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div><!-- End Donut Chart -->

                    <!-- Pie Chart -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Media Proportions <span>| All Time</span></h5>
                                <div id="pieChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#pieChart"), {
                                            series: @json($pieChartData),
                                            chart: {
                                                type: 'pie',
                                                height: 350,
                                                toolbar: { show: false },
                                            },
                                            labels: @json($pieChartLabels),
                                            colors: ['#FFD700', '#1E90FF', '#32CD32'],
                                            tooltip: {
                                                y: {
                                                    formatter: function(val) {
                                                        return val + " files";
                                                    }
                                                }
                                            },
                                            stroke: { width: 5, colors: ['#fff'] },
                                            fill: {
                                                type: 'gradient',
                                                gradient: {
                                                    shade: 'dark',
                                                    type: 'vertical',
                                                    gradientToColors: ['#FFD700', '#1E90FF', '#32CD32'],
                                                    stops: [0, 100]
                                                }
                                            },
                                            dropShadow: {
                                                enabled: true,
                                                top: 5,
                                                left: 2,
                                                blur: 3,
                                                color: '#000',
                                                opacity: 0.3
                                            }
                                        }).render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div><!-- End Pie Chart -->
                </div>
            </div>
        </div>
    </section>
@endsection
