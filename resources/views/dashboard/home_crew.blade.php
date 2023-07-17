@extends('layouts.main')

@section('title', 'Crew Dashboard')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Crew!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            {{-- <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            <h3>112</h3>
                            <span>Projects</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                        <div class="dash-widget-info">
                            <h3>44</h3>
                            <span>Clients</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                        <div class="dash-widget-info">
                            <h3>37</h3>
                            <span>Tasks</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h3>218</h3>
                            <span>Employees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Task List Asset in Vessel</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Vessel ID</th>
                                            <th>Asset Number</th>
                                            <th>Asset Name</th>
                                            <th>Information 3</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($asset as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->fixed_assets_number }}</td>
                                                <td>{{ $value->fixed_assets_name }}</td>
                                                <td>{{ $value->information3 }}</td>
                                                <td>
                                                    @if ($value->status_asset == 'DONT_EXIST')
                                                        <span class="badge badge-danger"> DONT EXIST</span>
                                                    @elseif ($value->status_asset == 'NEED_REPLACEMENT')
                                                        <span class="badge badge-warning"> Need
                                                            Replacement</span>
                                                    @elseif ($value->status_asset == 'NEED_REPAIR')
                                                        <span class="badge badge-warning"> Need
                                                            Repair</span>
                                                    @elseif ($value->status_asset == 'GOOD')
                                                        <span class="badge badge-success"> GOOD</span>
                                                    @elseif ($value->status_asset == 'GENERAL')
                                                        <span class="badge badge-secondary"> GENERAL</span>
                                                    @else
                                                        <span class="badge badge-dark">KOSONG</span>
                                                    @endif
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
