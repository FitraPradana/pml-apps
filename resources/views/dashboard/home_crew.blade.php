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
                                        <td>{{ $value->vessel_id }}</td>
                                        <td>{{ $value->fixed_assets_number }}</td>
                                        <td>{{ $value->fixed_assets_name }}</td>
                                        <td>{{ $value->information3 }}</td>
                                        <td>
                                            @if ($value->status_asset == 'general')
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-secondary"></i> General</a>'
                                            @elseif ($value->status_asset == 'good')
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> GOOD</a>
                                            @elseif ($value->status_asset == 'need')
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-warning"></i> Need Repair / Need Replacement</a>
                                            @elseif ($value->status_asset == 'dont_exist')
                                                <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Dont Exist</a>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <a href="invoices.html">View all invoices</a>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Payments</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Client</th>
                                        <th>Payment Type</th>
                                        <th>Paid Date</th>
                                        <th>Paid Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="invoice-view.html">#INV-0001</a></td>
                                        <td>
                                            <h2><a href="#">Global Technologies</a></h2>
                                        </td>
                                        <td>Paypal</td>
                                        <td>11 Mar 2019</td>
                                        <td>$380</td>
                                    </tr>
                                    <tr>
                                        <td><a href="invoice-view.html">#INV-0002</a></td>
                                        <td>
                                            <h2><a href="#">Delta Infotech</a></h2>
                                        </td>
                                        <td>Paypal</td>
                                        <td>8 Feb 2019</td>
                                        <td>$500</td>
                                    </tr>
                                    <tr>
                                        <td><a href="invoice-view.html">#INV-0003</a></td>
                                        <td>
                                            <h2><a href="#">Cream Inc</a></h2>
                                        </td>
                                        <td>Paypal</td>
                                        <td>23 Jan 2019</td>
                                        <td>$60</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="payments.html">View all payments</a>
                    </div>
                </div>
            </div> --}}
        </div>


    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

@endsection
