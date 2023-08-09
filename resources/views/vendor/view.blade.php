@extends('layouts.main')

@section('title', 'Data Vendor')

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
                        <h3 class="page-title">Vendor</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Master</a></li>
                            <li class="breadcrumb-item active">Vendor</li>
                        </ul>
                    </div>
                    {{-- <div class="btn-group">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_vendor"><i
                                class="fa fa-plus"></i> Add Vendor</a>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Import Vendor</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#import_vendor">Import</a>
                                <a class="dropdown-item" href="#">Template Import Vendor</a>
                            </div>
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
                    {{-- @if ($room->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        Data Room Masih KOSONG !!! Harap di Input terlebih dahulu
                    </div>
                @endif --}}

                    @if (session()->has('failures'))
                        <div class="alert alert-danger" role="alert">
                            Room Code (
                            @foreach (session()->get('failures') as $validasi)
                                {{ $validasi->values()[$validasi->attribute()] . ',' }}
                            @endforeach
                            ) is Duplicate
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
                                    {{-- <th>ID</th> --}}
                                    <th>Account</th>
                                    <th>Search Name</th>
                                    <th>Vendor Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Remarks</th>
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

        <!-- Import Site Modal -->
        {{-- @include('site.import_site') --}}
        <!-- /Import Site Modal -->

        <!-- Add Site Modal -->
        {{-- @include('site.add_modal') --}}
        <!-- /Add Site Modal -->


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
                ajax: "{{ url('vendor/json') }}",
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
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'accountnum',
                        name: 'accountnum'
                    },
                    {
                        data: 'search_name',
                        name: 'search_name'
                    },
                    {
                        data: 'vend_name',
                        name: 'vend_name'
                    },
                    {
                        data: 'vend_phone',
                        name: 'vend_phone'
                    },
                    {
                        data: 'vend_address',
                        name: 'vend_address'
                    },

                    {
                        data: 'vend_remarks',
                        name: 'vend_remarks'
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
