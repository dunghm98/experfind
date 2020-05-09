@extends('admin.layouts.app')

@section('admin-content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Hế lô admin nhaaa!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon text-primary border-primary">
											<i class="fe fe-users"></i>
										</span>
                                <div class="dash-count">
                                    <h3>{{$dataCount['collection']}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Thành Phố</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon text-success">
											<i class="fe fe-credit-card"></i>
										</span>
                                <div class="dash-count">
                                    <h3>{{$dataCount['course']}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Quận huyện</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon text-danger border-danger">
											<i class="fe fe-money"></i>
										</span>
                                <div class="dash-count">
                                    <h3>{{$dataCount['lesson']}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Chuyên môn</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon text-warning border-warning">
											<i class="fe fe-folder"></i>
										</span>
                                <div class="dash-count">
                                    <h3>{{$dataCount['user']}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Môn học</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-md-12 col-lg-6">--}}

{{--                    <!-- Sales Chart -->--}}
{{--                    <div class="card card-chart">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="card-title">Giao dịch</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div id="morrisArea"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /Sales Chart -->--}}

{{--                </div>--}}
{{--                <div class="col-md-12 col-lg-6">--}}

{{--                    <!-- Invoice Chart -->--}}
{{--                    <div class="card card-chart">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="card-title">Trạng thái</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div id="morrisLine"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /Invoice Chart -->--}}

{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
    <!-- /Page Wrapper -->



    @endsection