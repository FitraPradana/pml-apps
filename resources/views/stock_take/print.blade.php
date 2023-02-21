@extends('layouts.main')

@section('title', 'Print Out Stock Take Transaction')

@section('content')

<style>
    .center {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        flex: 1 0 100%;
    }
</style>

<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Berita Acara</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Print Out Update Asset</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-white">CSV</button>
                        <button class="btn btn-white">PDF</button>
                        <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="payslip-title">Berita Acara Update Status Asset</h4>
                        <div class="row">
                            <div class="col-sm-6 m-b-20">
                                <img src="{{ asset('assets/img/pml2.png') }}" class="inv-logo" alt="" style=""><br><br><br>
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
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <td>STATUS</td>
                                        <td>:</td>
                                        <td>
                                            @if ($stock_take->status_asset == 'dont_exist')
                                                <span class="badge badge-danger">DONT EXIST</span>
                                            @elseif ($stock_take->status_asset == 'need')
                                                <span class="badge badge-warning">Need Repair / Need Replacement</span>
                                            @else
                                                <span class="badge badge-dark">KOSONG</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DATE</td>
                                        <td>   :</td>
                                        <td>{{ $today }}</td>
                                      </tr>
                                    <tr>
                                        <td>USER</td>
                                        <td>   :</td>
                                        <td>{{ $stock_take->last_update_name }}</td>
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
                                        <th>Net Book Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $stock_take->fixed_asset->fixed_assets_number  }}</td>
                                        <td >{{ $stock_take->fixed_asset->fixed_assets_name  }}</td>
                                        <td >{{ $stock_take->fixed_asset->acquisition_date  }}</td>
                                        <td>{{ rupiah($stock_take->fixed_asset->net_book_value)  }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="invoice-info">
                                <h5>Reason</h5>
                                <p class="text-muted">{{ $stock_take->remarks_stock_take  }}</p>
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


@endsection
