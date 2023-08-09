@extends('layouts.main')

@section('title', 'Data Stock Take')

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
                        <h3 class="page-title">Stock Take</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Stock Take</li>
                        </ul>
                    </div>
                    {{-- <div class="btn-group">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_site"><i class="fa fa-plus"></i> Add Site</a>
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

                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif


                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>#</th>
                                    <th>Kode Stock Take</th>
                                    <th>Tanggal</th>
                                    <th>Fixed Assets Number</th>
                                    <th>Fixed Assets Name</th>
                                    <th>Status Asset</th>
                                    <th>Is Used</th>
                                    <th>Location</th>
                                    <th>Remarks Stock Take</th>
                                    <th>Last Image Condition</th>
                                    <th>Last Update Name</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
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
            // $('#room_id').select2({
            //     width: '250'
            // });

            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('/stock_takes/json') }}",
                columns: [{
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false
                    },
                    {
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'kode_stock_take',
                        name: 'kode_stock_take'
                    },
                    {
                        data: 'tgl_stock_take',
                        name: 'tgl_stock_take'
                    },
                    {
                        data: 'fixed_asset_id',
                        name: 'fixed_asset_id'
                    },
                    {
                        data: 'fixed_asset_name',
                        name: 'fixed_asset_name'
                    },
                    {
                        data: 'status_asset',
                        name: 'status_asset'
                    },
                    {
                        data: 'is_used',
                        name: 'is_used'
                    },
                    {
                        data: 'location_id',
                        name: 'location_id'
                    },
                    {
                        data: 'remarks_stock_take',
                        name: 'remarks_stock_take'
                    },
                    {
                        data: 'last_img_condition_stock_take',
                        name: 'last_img_condition_stock_take'
                    },
                    {
                        data: 'last_update_name',
                        name: 'last_update_name'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
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
