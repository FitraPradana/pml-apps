@extends('layouts.main')

@section('title', 'Data Document')

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
                    <h3 class="page-title">Document</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Administration</a></li>
                        <li class="breadcrumb-item active">Filling Document</li>
						<li class="breadcrumb-item active">Document</li>
                    </ul>
                </div>
                {{-- <div class="col-auto float-right ml-auto">
                    <div class="btn-group">
                        <a href="{{ url('fixed_assets_stg_save') }}" onclick="return confirm ('Are you sure to Get Data From ERP?')" class="btn btn-info"><i class="fa fa-plus"></i> Generate Asset from ERP</a>
                    </div>
                </div> --}}
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

        $(function () {
        // $(document).ready(function () {

            // SELECT2
            $('#room_id').select2({
                width: '250'
            });

            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy:    true,
                ajax: "{{ url('document/json') }}",
                columns: [
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: 'tgl_posting', name: 'tgl_posting' },
                    { data: 'voucher', name: 'voucher' },
                    { data: 'last_settle_voucher', name: 'last_settle_voucher'},
                    { data: 'last_settle_date', name: 'last_settle_date'},
                    { data: 'description', name: 'description' },
                    { data: 'nominal', name: 'nominal' },
                    { data: 'kode_vendor', name: 'kode_vendor' },
                    { data: 'nama_vendor', name: 'nama_vendor' },
                ]
            });
        });
</script>
@endsection

