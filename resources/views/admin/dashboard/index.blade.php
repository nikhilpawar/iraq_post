@extends('admin.layout.master')
@section('main_content')
  <!-- BEGIN: Main Menu-->
    @include('admin.layout._sidebar')
    <!-- END: Main Menu-->

  
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics" class="six-box-section">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>
                                        <h3 class="text-bold-600 mb-0">3000</h3>
                                        <p>Total Tickets</p>
                                    </div>
                                    <div class="avatar yellow-bck p-50 m-0">
                                        <div class="avatar-content">
                                          <i class="feather icon-layers"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>
                                        <h3 class="text-bold-600 mb-0">10</h3>
                                        <p>Today Tickets</p>
                                    </div>
                                    <div class="avatar yellow-bck p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fal fa-building"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>

                                        <h3 class="text-bold-600 mb-0">40</h3>
                                        <p>Open Tickets</p>
                                    </div>
                                    <div class="avatar yellow-bck p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fal fa-car-side"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       


                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>

                                        <h3 class="text-bold-600 mb-0">14</h3>
                                        <p>In Progress </p>
                                    </div>
                                    <div class="avatar yellow-bck p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fal fa-file-signature"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                              <div class="col-lg-2 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>

                                        <h3 class="text-bold-600 mb-0">2,140</h3>

                                        <p>On Hold</p>
                                    </div>
                                    <div class="avatar yellow-bck p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fal fa-wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-start pb-0">
                                    <div>

                                        <h3 class="text-bold-600 mb-0">3,140 </h3>
                                        <p>Closed Tickets</p>
                                    </div>
                                    <div class="avatar yellow-bck p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="fal fa-sack-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                </section>
                <!-- Dashboard Analytics end -->

            </div>

            <div class="content-body">

                <!-- apex charts section start -->
                <section id="apexchart" class="card-height-manage">
                    <div class="row">
                        <!-- Line Chart -->
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Last 10 Days Tickets</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="line-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Last 12 Month Tickets</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="bar-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Customer Type</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="pie-chart" class="mx-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart -->
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tickets Status</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="donut-chart" class="mx-auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <!-- line chart section start -->
                            <section id="chartjs-charts">
                                <!-- Line Chart -->
                                <!-- Bar Chart -->

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Top 5 Agents</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body pl-0">
                                            <div class="height-300">
                                                <canvas id="bar-chart-1"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- // line chart section end -->
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="card recent-booking-box">
                                <div class="card-header">
                                    <h4 class="card-title">Recent Tickets</h4>
                                    <h3><a href="#">See All</a> </h3>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="activity-timeline timeline-left list-unstyled">
                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-bookmark font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Abdullah Ali</p>
                                                    <span class="font-small-3"><span>Mob :</span> +96 1234567890 |</span>
                                                    <span class="font-small-3"><span>Class :</span> Economy</span>
                                                </div>
                                                <small class="text-muted">21 Oct 2020 to 28 Oct 2020 (7Days)</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-bookmark font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Abdullah Ali</p>
                                                    <span class="font-small-3"><span>Mob :</span> +96 1234567890 |</span>
                                                    <span class="font-small-3"><span>Class :</span> Economy</span>
                                                </div>
                                                <small class="text-muted">21 Oct 2020 to 28 Oct 2020 (7Days)</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-bookmark font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Abdullah Ali</p>
                                                    <span class="font-small-3"><span>Mob :</span> +96 1234567890 |</span>
                                                    <span class="font-small-3"><span>Class :</span> Economy</span>
                                                </div>
                                                <small class="text-muted">21 Oct 2020 to 28 Oct 2020 (7Days)</small>
                                            </li>
                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-bookmark font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Abdullah Ali</p>
                                                    <span class="font-small-3"><span>Mob :</span> +96 1234567890 |</span>
                                                    <span class="font-small-3"><span>Class :</span> Economy</span>
                                                </div>
                                                <small class="text-muted">21 Oct 2020 to 28 Oct 2020 (7Days)</small>
                                            </li>

                                            <li>
                                                <div class="timeline-icon bg-primary">
                                                    <i class="feather icon-bookmark font-medium-2 align-middle"></i>
                                                </div>
                                                <div class="timeline-info">
                                                    <p class="font-weight-bold mb-0">Abdullah Ali</p>
                                                    <span class="font-small-3"><span>Mob :</span> +96 1234567890 |</span>
                                                    <span class="font-small-3"><span>Class :</span> Economy</span>
                                                </div>
                                                <small class="text-muted">21 Oct 2020 to 28 Oct 2020 (7Days)</small>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                </section>
                <!-- // Apex charts section end -->

            </div>

            <!-- BEGIN: Content-->
            <div class="app-content content">
                <div class="content-overlay"></div>
                <div class="header-navbar-shadow"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-left mb-0">Chartjs</h2>
                                    <div class="breadcrumb-wrapper col-12">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">Charts &amp; Maps</a>
                                            </li>
                                            <li class="breadcrumb-item active">Chartjs
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                            <div class="form-group breadcrum-right">
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Content-->
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

@endsection