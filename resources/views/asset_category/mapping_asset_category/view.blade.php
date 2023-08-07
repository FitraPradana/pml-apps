@extends('layouts.main')

@section('title', 'Data Mapping Asset Category')

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
                        <h3 class="page-title">Mapping Asset Category</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Fixed Assets</a></li>
                            <li class="breadcrumb-item active">Mapping Asset Category</li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_mapping"><i
                                class="fa fa-plus"></i> Add Mapping Asset Category</a>
                    </div>

                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Import Mapping Asset Category</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#import_room">Import</a>
                            </div>
                        </div>
                        {{-- <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export Room</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('room.export') }}">Export</a>
                            </div>
                        </div> --}}
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
                                    <th>ID Mapping</th>
                                    <th>Asset Category</th>
                                    <th>Location</th>
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

        <!-- Import Room Modal -->
        {{-- @include('room.import_room') --}}
        <!-- /Import Room Modal -->

        <!-- Add Mapping Asset Category Modal -->
        @include('asset_category.mapping_asset_category.add_mapping_asset_category')
        <!-- /Add Mapping Asset Category Modal -->


    </div>
    <!-- /Page Wrapper -->


@endsection



@section('under_body')

    <script type="text/javascript">
        $(function() {
            // $(document).ready(function () {


            // SELECT2
            $('#location_id').select2({
                width: '100%'
            });
            $('#asset_category_id').select2({
                width: '100%'
            });
            $('#site_code').select2({
                width: '100%'
            });

            // GLOBAL SETUP
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('/map_ast_cat_view_json') }}",
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
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'asset_category_id',
                        name: 'asset_category_id'
                    },
                    {
                        data: 'location_id',
                        name: 'location_id'
                    },
                    {
                        data: 'remarks_mapping_asset_category',
                        name: 'remarks_mapping_asset_category'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                ]
            });


            // Change Sites
            $('#site_code').change(function() {
                var id = $(this).val();

                $('#location_id').find('option').not(':first').remove();

                $.ajax({
                    url: 'getLocationJson/' + id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response.data != null) {
                            len = response.data.length;
                        }
                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var id = response.data[i].id;
                                var name = response.data[i].room_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $("#location_id").append(option);
                            }
                        }
                    }
                })
            });

        });
    </script>

@endsection
