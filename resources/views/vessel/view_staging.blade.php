@extends('layouts.main')

@section('title', 'Data Staging Vessel')

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
                        <h3 class="page-title">Staging Vessel</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active">Staging From ERP</li>
                            <li class="breadcrumb-item active">Staging Vessel</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group">
                            <a href="{{ url('vessels_stg_save') }}"
                                onclick="return confirm ('Are you sure to Get Data From ERP?')" class="btn btn-info"><i
                                    class="las la-sync"></i> Generate VESSEL from ERP</a>
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
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-nowrap custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vessel ID</th>
                                    <th>Vessel Name</th>
                                    <th>Vessel Type</th>
                                    <th>Vessel Class</th>
                                    <th>Site</th>
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
        // $(function () {
        $(document).ready(function() {


            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('vessels_stg_json') }}",
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'VessID',
                        name: 'VessID'
                    },
                    {
                        data: 'VessName',
                        name: 'VessName'
                    },
                    {
                        data: 'VessType',
                        name: 'VessType'
                    },
                    {
                        data: 'VessClassID',
                        name: 'VessClassID'
                    },
                    {
                        data: 'SiteId',
                        name: 'SiteId'
                    },
                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'pageLength',
                    {
                        "extend": "colvis",
                        "text": "Show/Hide Columns"
                    },
                    'copy', 'csv',
                    {
                        extend: "excel",
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'print'
                ],
            });
        });
    </script>
@endsection
