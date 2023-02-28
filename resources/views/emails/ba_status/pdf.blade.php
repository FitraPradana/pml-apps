@inject('carbon', 'Carbon\Carbon')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="PML - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>PML - Invoice BA Assets</title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="/assets/img/people.png"> --}}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ public_path('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    {{-- <link rel="stylesheet" href="/assets/css/font-awesome.min.css"> --}}

    <!-- Lineawesome CSS -->
    {{-- <link rel="stylesheet" href="/assets/css/line-awesome.min.css"> --}}

    <!-- Datatable CSS -->
    {{-- <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css"> --}}


    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    {{-- [if lt IE 9]
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		[endif] --}}

    <style>
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            flex: 1 0 100%;
        }
    </style>
</head>

<body>


    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="payslip-title">Berita Acara Update Status Asset</h4>
                                <div class="row">
                                    <div class="col-sm-6 m-b-20">
                                        <img src="{{ public_path('assets/img/pml2.png') }}" class="inv-logo"
                                            alt="" style=""><br><br><br>
                                        {{-- <ul class="list-unstyled">
                                    <li>Dreamguy's Technologies</li>
                                    <li>3864 Quiet Valley Lane,</li>
                                    <li>Sherman Oaks, CA, 91403</li>
                                    <li>GST No:</li>
                                </ul> --}}
                                        <table>
                                            <tr>
                                                <td>Perihal,</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>STATUS</td>
                                                <td>:</td>
                                                <td>
                                                    @if ($stock_take->status_asset == 'dont_exist')
                                                        <span class="badge badge-danger"> DONT EXIST</span>
                                                    @elseif ($stock_take->status_asset == 'need')
                                                        <span class="badge badge-warning"> Need Repair / Need
                                                            Replacement</span>
                                                    @elseif ($stock_take->status_asset == 'good')
                                                        <span class="badge badge-success"> GOOD</span>
                                                    @elseif ($stock_take->status_asset == 'general')
                                                        <span class="badge badge-secondary"> GENERAL</span>
                                                    @else
                                                        <span class="badge badge-dark">KOSONG</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>DATE</td>
                                                <td> :</td>
                                                <td>{{ $today }}</td>
                                            </tr>
                                            <tr>
                                                <td>USER</td>
                                                <td> :</td>
                                                <td>{{ $stock_take->last_update_name }}</td>
                                                {{-- <td>Fijay</td> --}}
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="col-sm-6 m-b-20">
                                        <div class="invoice-details">
                                            {{-- <h3 class="text-uppercase">Invoice #INV-0001</h3>
                                    <ul class="list-unstyled">
                                        <li>Date: <span>March 12, 2019</span></li>
                                        <li>Due date: <span>April 25, 2019</span></li>
                                    </ul> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Asset Number</th>
                                                <th class="d-none d-sm-table-cell">Asset Name</th>
                                                <th>Acquisition Date</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $stock_take->fixed_assets_number }}</td>
                                                <td>{{ $stock_take->fixed_assets_name }}</td>
                                                <td>{{ $carbon::parse($stock_take->acquisition_date)->format('d M Y') }}
                                                </td>
                                                <td>{{ $stock_take->location_name }}</td>
                                                {{-- <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td> --}}
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <div class="invoice-info">
                                        <h5>Reason</h5>
                                        <p class="text-muted">{{ $stock_take->remarks_stock_take }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->

        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

</body>

</html>
