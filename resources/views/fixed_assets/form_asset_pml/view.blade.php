@extends('layouts.main')

@section('title', 'Data Form Asset PML')

@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Form Asset PML</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Fixed Assets</a></li>
                            <li class="breadcrumb-item active">Form Asset PML</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            @if (Auth::user()->roles == 'admin')
                <form action="{{ route('form_asset_view') }}" method="POST">
                    @csrf
                    @method('POST')
                    <!-- Search Filter -->
                    <div class="row filter-row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group form-focus select-focus">
                                <select class="select floating" id="filter_sites" name="filter_sites">
                                    <option value=""> -- Select -- </option>
                                    @foreach ($sites as $val)
                                        <option value="{{ $val->site_code }}">{{ $val->site_code }} - {{ $val->site_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="focus-label">Sites</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            {{-- <a href="#" class="btn btn-success btn-block"> Search </a> --}}
                            <button type="submit" class="btn btn-success btn-block"> Search </button>
                        </div>
                    </div>
                    <!-- /Search Filter -->
                </form>
            @endif


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
        $(function() {
            // SELECT2
            $('#fixed_assets_id').select2({});
            $('#filter_sites').select2({
                width: '100%'
            });
        });
    </script>
@endsection
