@extends('layouts.main')

@section('title', 'Ticketing Requset Job IT PML')

@section('content')


    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Request Job IT Dashboard</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item">Jobs</li>
                            <li class="breadcrumb-item">Request Jobs IT</li>
                            {{-- <li class="breadcrumb-item"></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Solid justified</h4> -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                        <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#">Jobs IT PML </a></li>
                        <li class="nav-item"><a class="nav-link" href="#">ERP Development</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">VMS Development</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Customer</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Vendor</a></li>
                    </ul>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select</option>
                            <option>Development</option>
                            <option>Designing</option>
                            <option>Android</option>
                        </select>
                        <label class="focus-label">Department</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select</option>
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Internship</option>
                        </select>
                        <label class="focus-label">Job Type</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select Designation</option>
                            <option>Web Developer</option>
                            <option>Web Designer</option>
                            <option>Android Developer</option>
                            <option>Ios Developer</option>
                        </select>
                        <label class="focus-label">Designation</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="btn btn-dark btn-block"> Search </a>
                </div>
            </div>
            <!-- Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>By System</th>
                                    <th>Job Title</th>
                                    <th>Due Date</th>
                                    <th>Approved PIC</th>
                                    <th>Remarks</th>
                                    <th style="background-color: rgb(149, 211, 149)">Reassigned</th>
                                    <th style="background-color: rgb(149, 211, 149)">Action Date</th>
                                    <th style="background-color: rgb(149, 211, 149)">IT PIC</th>
                                    <th style="background-color: rgb(149, 211, 149)">Remarks Action</th>
                                    <th>Action Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="job-details.html">Web Developer</a></td>
                                    <td>Development</td>
                                    <td>3 Mar 2019</td>
                                    <td>31 May 2019</td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Full Time
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-label">
                                            <a class="btn btn-white btn-sm btn-rounded" href="#"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-danger"></i> Open
                                            </a>

                                        </div>
                                    </td>
                                    <td>test 1</td>
                                    <td>test 2</td>
                                    <td>test 3</td>
                                    <td>test 4</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- /Content End -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->


@endsection
