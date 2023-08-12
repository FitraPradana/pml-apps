@extends('layouts.main')

@section('title', 'Crew Dashboard')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Crew {{ Auth::user()->email }} !</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row filter-row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="filter_tug" style="width: 100%" disabled>
                            @foreach ($data_tug as $val)
                                <option value="{{ $val->site_code }}">{{ $val->site_code }} - {{ $val->site_name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="focus-label">TUG</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="filter_barge" style="width: 100%" disabled>
                            @foreach ($data_barge as $val)
                                <option value="{{ $val->site_code }}">{{ $val->site_code }} - {{ $val->site_name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="focus-label">Barge</label>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            <h3>112</h3>
                            <span>Projects</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                        <div class="dash-widget-info">
                            <h3>44</h3>
                            <span>Clients</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                        <div class="dash-widget-info">
                            <h3>37</h3>
                            <span>Tasks</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h3>218</h3>
                            <span>Employees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0" id="title_tug">ASSET TUG</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatables_tug" class="table table-nowrap custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Fixed Asset Number</th>
                                            <th>Fixed Asset Name</th>
                                            <th>Status</th>
                                            <th>Is Used</th>
                                            <th>Location</th>
                                            <th>Site</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#">View all asset TUG</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 id="title_barge" class="card-title mb-0">ASSET BARGE</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatables_barge" class="table custom-table table-nowrap mb-0 datatables_barge">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Fixed Asset Number</th>
                                            <th>Fixed Asset Name</th>
                                            <th>Status</th>
                                            <th>Is Used</th>
                                            <th>Location</th>
                                            <th>Site</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#">View all asset BARGE</a>
                        </div>
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
        $(document).ready(function() {
            // SELECT2
            $('#filter_tug').select2({
                // width: '1000px'
            });
            $('#filter_barge').select2({
                // width: '500px'
            });

            // GLOBAL SETUP
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // TUG
            var id_tug = $('#filter_tug').val()
            var name_tug = $("#filter_tug").find(":selected").text()
            var title_tug = $("#title_tug").text('ASSET TUG >>>>> ' + name_tug)
            var table_tug = $('#datatables_tug').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: "{{ url('report_vessels_get_tug') }}",
                    type: "POST",
                    data: function(d) {
                        d.on_tug = id_tug
                        return d
                    }
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'fixed_assets_number',
                        name: 'fixed_assets_number'
                    },
                    {
                        data: 'fixed_assets_name',
                        name: 'fixed_assets_name'
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
                        data: 'site_code',
                        name: 'site_code'
                    },
                ]
            });
            table_tug.ajax.reload(null, false)
            // END TUG


            // BARGE
            var id_barge = $('#filter_barge').val()
            var name_barge = $("#filter_barge").find(":selected").text()
            var title_barge = $("#title_barge").text('ASSET BARGE >>>>> ' + name_barge)
            var table_barge = $('#datatables_barge').DataTable({
                processing: true,
                serverSide: true,
                // allowPageScroll: true,
                destroy: true,
                // scrollX: true,
                ajax: {
                    url: "{{ url('report_vessels_get_barge') }}",
                    type: "POST",
                    data: function(d) {
                        d.on_barge = id_barge
                        return d
                    }
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings
                                ._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'fixed_assets_number',
                        name: 'fixed_assets_number'
                    },
                    {
                        data: 'fixed_assets_name',
                        name: 'fixed_assets_name'
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
                        data: 'site_code',
                        name: 'site_code'
                    },
                ]
            });
            table_barge.ajax.reload(null, false)
            // END BARGE



        });
    </script>


@endsection
