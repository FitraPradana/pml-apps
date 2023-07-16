@extends('layouts.main')

@section('title', 'Data Set Pair')

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
                        <h3 class="page-title">Set Pair</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Set Pair</a></li>
                            <li class="breadcrumb-item active">Set Pair</li>
                        </ul>
                    </div>
                    {{-- <div class="btn-group">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_site"><i
                                class="fa fa-plus"></i> Add Site</a>
                    </div> --}}
                    <div class="col-auto float-right ml-auto">
                        {{-- <div class="btn-group">
                            <button type="button" class="btn btn-dark btn-rounded dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Import Site</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#import_site">Import</a>
                                <a class="dropdown-item" href="#">Template Import Site</a>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-rounded dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export Site</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('site.export') }}">Export</a>
                                <a class="dropdown-item" href="#">Template Export Site</a>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
            <!-- /Page Header -->


            <div class="row">
                <div class="col-md-12">


                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>ID Set Type Tug Barge</th>
                                    <th>Month</th>
                                    <th>year</th>
                                    <th>First Date</th>
                                    <th>Tug</th>
                                    <th>Tug Name</th>
                                    <th>Barge</th>
                                    <th>Barge Name</th>
                                    <th>Is Active</th>
                                    <th>Tug Power</th>
                                    <th>Barge Capacity</th>
                                    <th>Set Type Name</th>
                                    <th>Voyage Number</th>
                                    <th>Created Date</th>
                                    <th>Created User</th>
                                    <th>IP User Updated</th>
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
                ajax: "{{ url('/settype_tugbarge/json') }}",
                columns: [
                    // {
                    //     render: function(data, type, row, meta) {
                    //         return meta.row + meta.settings._iDisplayStart + 1;
                    //     },
                    // },
                    {
                        data: 'id_settype_tugbarge',
                        name: 'id_settype_tugbarge'
                    },
                    {
                        data: 'month',
                        name: 'month'
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'first_date',
                        name: 'first_date'
                    },
                    {
                        data: 'tug',
                        name: 'tug'
                    },
                    {
                        data: 'tug_name',
                        name: 'tug_name'
                    },
                    {
                        data: 'barge',
                        name: 'barge'
                    },
                    {
                        data: 'barge_name',
                        name: 'barge_name'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'tug_power',
                        name: 'tug_power'
                    },
                    {
                        data: 'barge_capacity',
                        name: 'barge_capacity'
                    },
                    {
                        data: 'settype_name',
                        name: 'settype_name'
                    },
                    {
                        data: 'voyage_number',
                        name: 'voyage_number'
                    },
                    {
                        data: 'created_date',
                        name: 'created_date'
                    },
                    {
                        data: 'created_user',
                        name: 'created_user'
                    },
                    {
                        data: 'ip_user_updated',
                        name: 'ip_user_updated'
                    },
                ]
            });
        });
    </script>

@endsection
