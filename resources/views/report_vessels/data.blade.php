@extends('layouts.main')

@section('title', 'Data Report per Vessels')

@section('content')


    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Report Vessels</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Fixed Assets</a></li>
                            <li class="breadcrumb-item active">Report Per-Vessel</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        {{-- <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i
                                class="fa fa-plus"></i> Add Leave</a> --}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->
            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Today Presents</h6>
                        <h4>12 / 60</h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Planned Leaves</h6>
                        <h4>8 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Unplanned Leaves</h6>
                        <h4>0 <span>Today</span></h4>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-info">
                        <h6>Pending Requests</h6>
                        <h4>12</h4>
                    </div>
                </div>
            </div> --}}
            <!-- /Leave Statistics -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">
                    <div class="form-group form-focus">
                        <input type="hidden" class="form-control floating">
                        {{-- <label class="focus-label">Employee Name</label> --}}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="filter_tug">
                            <option value=""> -- Select -- </option>
                            @foreach ($data_tug as $val)
                                <option value="{{ $val->site_code }}">{{ $val->site_code }} - {{ $val->site_name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="focus-label">TUG</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                    <div class="form-group form-focus select-focus">
                        <input type="hidden" class="floating" id="id_barge">
                        {{-- <label class="focus-label">BARGE</label> --}}
                    </div>
                </div>
            </div>
            <!-- /Search Filter -->

            <di<div class="row">
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
    </div>
    <!-- /Page Content -->


    </div>
    <!-- /Page Wrapper -->
@endsection


@section('under_body')
    <script type="text/javascript">
        $(function() {
            // SELECT2
            $('#filter_tug').select2({
                // width: '250'
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
            var title_tug = $("#title_tug").find(":selected").text()
            var table_tug = $('#datatables_tug').DataTable({
                processing: true,
                serverSide: true,
                // allowPageScroll: true,
                destroy: true,
                // scrollX: true,
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
            // END TUG

            // CHANGE FILTER
            csrf_token = $('meta[name="csrf-token"]').attr('content');
            $('#filter_tug').on('change', function() {
                id_tug = $(this).val()
                name_tug = $("#filter_tug").find(":selected").text()
                title_tug = $("#title_tug").text('ASSET TUG >>>>> ' + name_tug)
                id_barge = $('#id_barge').val()

                // BARGE
                $.ajax({
                    url: "{{ url('get_barge') }}",
                    type: "POST",
                    data: {
                        '_method': 'POST',
                        '_token': csrf_token,
                        'on_tug': id_tug,
                    },
                    success: function(response) {
                        console.log(response.id_barge)
                        let id_barge = response.id_barge
                        let nama_barge = response.nama_barge
                        title_tug = $("#title_barge").text('ASSET BARGE >>>>> ' + id_barge +
                            ' - ' + nama_barge)
                        $("#id_barge").val(id_barge)

                        // BARGE
                        // var id_barge = $('#id_barge').val()
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
                        // END BARGE


                        table_barge.ajax.reload(null, false)
                    }
                })

                table_tug.ajax.reload(null, false)
                console.log(title_tug);
            })
            // END CHANGE FILTER




            // TESTING
            // csrf_token = $('meta[name="csrf-token"]').attr('content');
            // $('#filter_tug').change(function() {
            //     var id_tug = $(this).val();
            //     $.ajax({
            //         url: "{{ url('scan_vessels_get_tugbarge') }}",
            //         type: "POST",
            //         data: {
            //             '_method': 'POST',
            //             '_token': csrf_token,
            //             'on_tug': id_tug,
            //         },
            //         success: function(response) {
            //             console.log(response.id_tug);
            //             // alert(response.berhasil);
            //         }
            //     })
            // });
            // END TESTING



        });
    </script>


@endsection
