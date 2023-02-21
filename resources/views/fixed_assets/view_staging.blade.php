@extends('layouts.main')

@section('title', 'Data Fixed Assets')

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
                    <h3 class="page-title">Staging Assets</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Administration</a></li>
                        <li class="breadcrumb-item active">Fixed Assets</li>
						<li class="breadcrumb-item active">Staging Assets</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group">
                        <a href="{{ url('fixed_assets_stg_save') }}" onclick="return confirm ('Are you sure to Get Data From ERP?')" class="btn btn-info"><i class="las la-sync"></i> Generate Asset from ERP</a>
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
                            @if (session()->has('error_site_kosong'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error_site_kosong') }} <a href="{{ url('sites_stg_index') }}"> Form SITES Staging >>> </a>
                                </div>
                            @endif
                <div class="table-responsive">
                    <table id="datatables" class="table table-striped table-nowrap custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fixed Asset Number</th>
                                <th>Fixed Asset Name</th>
                                <th>Fixed Asset Group</th>
                                <th>Main Fixed Asset</th>
                                <th>Information 3</th>
                                <th>Vessel ID</th>
                                <th>Acquisition Date</th>
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
                ajax: "{{ url('fixed_assets_stg_json') }}",
                columns: [
                    {
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    { data: 'AssetId', name: 'AssetId' },
                    { data: 'Name', name: 'Name'},
                    { data: 'AssetGroup', name: 'AssetGroup'},
                    { data: 'MainAssetId', name: 'MainAssetId' },
                    { data: 'MaintenanceInfo3', name: 'MaintenanceInfo3' },
                    { data: 'KREVesselId', name: 'KREVesselId' },
                    { data: 'AcquisitionDate', name: 'AcquisitionDate' },
                    // { data: 'net_book_value', name: 'net_book_value' },
                ]
            });
        });
</script>
@endsection

