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

            {{-- <div class="row filter-row">
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
            </div> --}}

            @foreach ($location as $item)
                <section class="review-section">
                    <div class="review-header text-center">
                        <h3 class="review-title">{{ $item->site_name }}</h3>
                        <p class="text-muted">{{ $item->room_name }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered review-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>QR Code</th>
                                            <th>Asset Category</th>
                                            <th>Asset Number</th>
                                            <th>Asset Description</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($mapping_asset as $val)
                                            @if ($val->room_id === $item->room_id)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td style="text-align:center">
                                                        @foreach ($assets as $ast)
                                                            @if ($ast->asset_category_id === $val->asset_category_id and $ast->location_id === $val->location_id)
                                                                {!! QrCode::size(70)->generate($ast->qr_code) !!}
                                                            @endif
                                                        @endforeach

                                                    </td>
                                                    <td>{{ $val->asset_category_name }}</td>
                                                    <td>
                                                        @foreach ($assets as $ast)
                                                            @if ($ast->asset_category_id === $val->asset_category_id and $ast->location_id === $val->location_id)
                                                                {{ $ast->fixed_assets_number }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($assets as $ast)
                                                            @if ($ast->asset_category_id === $val->asset_category_id and $ast->location_id === $val->location_id)
                                                                {{ $ast->information3 }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($assets as $ast)
                                                            @if ($ast->asset_category_id === $val->asset_category_id and $ast->location_id === $val->location_id)
                                                                {{ $ast->remarks_fixed_assets }}
                                                            @endif
                                                        @endforeach
                                                    </td>

                                                </tr>
                                                {{-- @if ($val->asset_category_id->count() == 0)
                                                    <tr>
                                                        <td colspan="5" style="text-align: center"> No Data Available
                                                        </td>
                                                    </tr>
                                                @endif --}}
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach



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
