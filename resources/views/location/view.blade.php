@extends('layouts.main')

@section('title', 'Data Location')

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
                        <h3 class="page-title">Location</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Master</a></li>
                            <li class="breadcrumb-item active">Location</li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_location"><i
                                class="fa fa-plus"></i> Add Location</a>
                    </div>
                    {{-- <div class="col-auto float-right ml-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Import Location</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#import_location">Import</a>
                            <a class="dropdown-item" href="#">Template Import Location</a>
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
                    @if ($room->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            Data Room Masih KOSONG !!! Harap di Input terlebih dahulu
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
                                    {{-- <th>ID Location</th> --}}
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Site</th>
                                    <th>Room</th>
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

        <!-- Add Location Modal -->
        @include('location.add_modal')
        <!-- /Add Location Modal -->


    </div>
    <!-- /Page Wrapper -->
@endsection



@section('under_body')

    <script type="text/javascript">
        $(function() {
            // $(document).ready(function () {

            // SELECT2
            $('#site_id').select2({
                width: '250'
            });
            $('#room_id').select2({
                width: '250'
            });
            // END SELECT2

            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ url('/location/json') }}",
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
                    // { data: 'id', name: 'id' },
                    {
                        data: 'location_code',
                        name: 'location_code'
                    },
                    {
                        data: 'location_name',
                        name: 'location_name'
                    },
                    {
                        data: 'site_id',
                        name: 'site_id'
                    },
                    {
                        data: 'room_id',
                        name: 'room_id'
                    },
                    {
                        data: 'location_remarks',
                        name: 'location_remarks'
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
        });
    </script>

@endsection
