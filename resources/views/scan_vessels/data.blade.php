@extends('layouts.main')

@section('title', 'Data Report per Vessels')

@section('content')


    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Scan Vessels</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Apps</a></li>
                            <li class="breadcrumb-item active">Scan Per-Vessel</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i
                                class="fa fa-plus"></i> Add Leave</a> --}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->
            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Today Presents</h6>
                        <h4>12 / 60</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Planned Leaves</h6>
                        <h4>8 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Unplanned Leaves</h6>
                        <h4>0 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Pending Requests</h6>
                        <h4>12</h4>
                    </div>
                </div>
            </div> --}}
            <!-- /Leave Statistics -->

            <!-- Search Filter -->
            <div class="row filter-row">
                {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div> --}}
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="data_tug">
                            <option value=""> -- Select -- </option>
                            @foreach ($data_tug as $val)
                                <option value="{{ $val->site_code }}">{{ $val->site_code }} - {{ $val->site_name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="focus-label">TUG</label>
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option> -- Select -- </option>
                            <option> Pending </option>
                            <option> Approved </option>
                            <option> Rejected </option>
                        </select>
                        <label class="focus-label">Leave Status</label>
                    </div>
                </div> --}}
                {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">From</label>
                    </div>
                </div> --}}
                {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating datetimepicker" type="text">
                        </div>
                        <label class="focus-label">To</label>
                    </div>
                </div> --}}
                {{-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div> --}}
            </div>
            <!-- /Search Filter -->

            <di<div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">TUG</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Fixed Asset Number</th>
                                            <th>Fixed Asset Name</th>
                                            <th>Status</th>
                                            <th>Is Used</th>
                                            {{-- <th>Total</th>
                                            <th>Status</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="invoice-view.html">#INV-0001</a></td>
                                            <td></td>
                                            <h2><a href="#">Global Technologies</a></h2>
                                            </td>
                                            <td>
                                                <span class="badge bg-inverse-danger">Dont Exist</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-inverse-success">TERPAKAI</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="invoice-view.html">#INV-0001</a></td>
                                            <td>
                                                <h2><a href="#">Global Technologies</a></h2>
                                            </td>
                                            <td>
                                                <span class="badge bg-inverse-danger">Dont Exist</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-inverse-success">TERPAKAI</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="invoices.html">View all invoices</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">BARGE</h3>
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
                </div>
        </div>
    </div>
    </div>
    <!-- /Page Content -->


    </div>
    <!-- /Page Wrapper -->
@endsection


@section('under_body')
    <script type="text/javascript">
        $(function() {
            // SELECT2
            $('#data_tug').select2({
                // width: '250'
            });


            // $('#data_tug').click(function() {
            //     var url = '/ajax/get_discount_code';
            //     var example = 'CONTOH';
            //     $.get(url, function(data) {
            //         console.log(data);
            //     });
            // });


            $('#data_tug').change(function() {
                var id_tug = $(this).val();

                alert(id_tug);
            });



        });
    </script>


@endsection
