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
                        <h3 class="page-title">Assets</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Administration</a></li>
                            <li class="breadcrumb-item active">Fixed Assets</li>
                            <li class="breadcrumb-item active">Assets</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            {{-- <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Solid justified</h4> -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                        <li class="nav-item"><a class="nav-link active" href="user-dashboard.html">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="user-all-jobs.html">All </a></li>
                        <li class="nav-item"><a class="nav-link" href="saved-jobs.html">Saved</a></li>
                        <li class="nav-item"><a class="nav-link" href="applied-jobs.html">Applied</a></li>
                        <li class="nav-item"><a class="nav-link" href="interviewing.html">Interviewing</a></li>
                        <li class="nav-item"><a class="nav-link" href="offered-jobs.html">Offered</a></li>
                        <li class="nav-item"><a class="nav-link" href="visited-jobs.html">Visitied </a></li>
                        <li class="nav-item"><a class="nav-link" href="archived-jobs.html">Archived </a></li>
                    </ul>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="col-auto float-right ml-auto">
                        {{-- <div class="btn-group">
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#up_image"><i class="fa fa-image"></i> Upload Image</a>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_asset"><i class="fa fa-plus"></i> Add Asset</a>
                    </div> --}}
                        {{-- <div class="btn-group">
                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Import Fixed Assets</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import_fixed_assets">Import</a>
                            <a class="dropdown-item" href="#">Template Import Fixed Assets</a>
                        </div>
                    </div> --}}
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Update Net Book Value</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import_nbv">Update
                                    NBV</a>
                                {{-- <a class="dropdown-item" href="#">Template Update NBV</a> --}}
                            </div>
                        </div>
                        {{-- <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export Fixed Assets</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('fixed_asset.export')}}">Export</a>
                            <a class="dropdown-item" href="#">Template Export Fixed Assets</a>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div><br><br>

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

                    @if (session()->has('failures'))
                        <div class="alert alert-danger" role="alert">
                            Fixed Assets Number (
                            @foreach (session()->get('failures') as $validasi)
                                {{ $validasi->values()[$validasi->attribute()] . ',' }}
                            @endforeach
                            ) is Duplicate
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-nowrap custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>#</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Is Used</th>
                                    <th>Fixed Asset Number</th>
                                    {{-- <th>Fixed Asset Name</th> --}}
                                    <th>Information 3</th>
                                    <th>Fixed Asset Group</th>
                                    <th>Fixed Asset Category</th>
                                    <th>Main Fixed Asset</th>
                                    {{-- <th>Vessel ID</th> --}}
                                    <th>Location</th>
                                    <th>Acquisition Date</th>
                                    <th>Net Book Value</th>
                                    <th>Last Update</th>
                                    <th>PIC</th>
                                    <th>Remarks</th>
                                    <th>Last Modified Name</th>
                                    {{-- <th class="text-center">QR Code</th> --}}
                                    {{-- <th>Image Asset</th> --}}
                                    <th>Last Image Condition</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
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

        <!-- Import Asset Modal -->
        @include('fixed_assets.modal_import_asset')
        <!-- /Import Asset Modal -->

        <!-- Update NBV Modal -->
        @include('fixed_assets.modal_update_nbv')
        <!-- /Update NBV Modal -->

        <!-- Add Asset Modal -->
        {{-- @include('fixed_assets.modal_add') --}}
        <!-- /Add Asset Modal -->

        <!-- Upload Image Modal -->
        {{-- @include('fixed_assets.upload_image') --}}
        <!-- /Upload Image Modal -->

    </div>
    <!-- /Page Wrapper -->
@endsection

@section('under_body')

    <script type="text/javascript">
        $(function() {
            // $(document).ready(function () {

            // GLOBAL SETUP
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var table = $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                // allowPageScroll: true,
                destroy: true,
                // scrollX: true,
                // order: [],
                ajax: "{{ url('/fixed_asset/json') }}",
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
                        data: 'status_asset',
                        name: 'status_asset'
                    },
                    {
                        data: 'is_used',
                        name: 'is_used'
                    },
                    {
                        data: 'fixed_assets_number',
                        name: 'fixed_assets_number'
                    },
                    // {
                    //     data: 'fixed_assets_name',
                    //     name: 'fixed_assets_name'
                    // },
                    {
                        data: 'information3',
                        name: 'information3'
                    },
                    {
                        data: 'fixed_assets_group',
                        name: 'fixed_assets_group'
                    },
                    {
                        data: 'asset_category_id',
                        name: 'asset_category_id'
                    },
                    {
                        data: 'main_fixed_assets',
                        name: 'main_fixed_assets'
                    },

                    // {
                    //     data: 'vessel_id',
                    //     name: 'vessel_id'
                    // },
                    {
                        data: 'location_id',
                        name: 'location_id'
                    },
                    {
                        data: 'acquisition_date',
                        name: 'acquisition_date'
                    },
                    {
                        data: 'net_book_value',
                        name: 'net_book_value'
                    },
                    {
                        data: 'last_update_stock_take_date',
                        name: 'last_update_stock_take_date'
                    },
                    {
                        data: 'pic',
                        name: 'pic'
                    },
                    {
                        data: 'remarks_fixed_assets',
                        name: 'remarks_fixed_assets'
                    },
                    {
                        data: 'last_modified_name',
                        name: 'last_modified_name'
                    },
                    // {
                    //     data: 'qr_code',
                    //     name: 'qr_code',
                    //     searchable: false,
                    //     sortable: false
                    // },
                    // {
                    //     data: 'img_asset',
                    //     name: 'img_asset'
                    // },
                    {
                        data: 'last_img_condition_stock_take',
                        name: 'last_img_condition_stock_take'
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


            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteAsset', function() {

                var asset_id = $(this).data("id");
                var result = confirm("Are you sure to delete?");
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('fixed_assets.store') }}" + '/' + asset_id,
                        success: function(data) {
                            table.draw();
                            Swal.fire(
                                'Data Berhasil di Hapus!',
                                'You clicked the button!',
                                'success'
                            )
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
            // End Delete Product Code


        });
    </script>
@endsection
