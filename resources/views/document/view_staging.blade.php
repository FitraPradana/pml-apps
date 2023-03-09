@extends('layouts.main')

@section('title', 'Data Staging Document')

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
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Staging Document</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active">Filling Document</li>
                            <li class="breadcrumb-item active">Staging Document</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group">
                            <a href="{{ url('doc_stg_save') }}"
                                onclick="return confirm ('Are you sure to Get Data Document From ERP?')"
                                class="btn btn-info"><i class="las la-sync"></i> Generate DOCUMENT from ERP</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session()->has('error_vendor_kosong'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_vendor_kosong') }} <a href="{{ url('vendors_stg_index') }}"> Form ROOM >>>
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-nowrap custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Posting</th>
                                    <th>Voucher</th>
                                    <th>Last Settle Voucher</th>
                                    <th>Last Settle Date</th>
                                    <th>Description</th>
                                    <th>Nominal</th>
                                    <th>Kode Vendor</th>
                                    <th>Nama Vendor</th>
                                    {{-- <th>Net Book Value</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
            // $(document).ready(function () {

            // SELECT2
            $('#room_id').select2({
                width: '250'
            });

            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('doc_stg_json') }}",
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'TransDate',
                        name: 'TransDate'
                    },
                    {
                        data: 'Voucher',
                        name: 'Voucher'
                    },
                    {
                        data: 'LastSettleVoucher',
                        name: 'LastSettleVoucher'
                    },
                    {
                        data: 'LastSettleDate',
                        name: 'LastSettleDate'
                    },
                    {
                        data: 'Txt',
                        name: 'Txt'
                    },
                    {
                        data: 'AmountCur',
                        name: 'AmountCur'
                    },
                    {
                        data: 'AccountNum',
                        name: 'AccountNum'
                    },
                    {
                        data: 'VendorName',
                        name: 'VendorName'
                    },
                ]
            });
        });
    </script>
@endsection
