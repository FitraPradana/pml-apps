@extends('layouts.main')

@section('title', 'List Barcode')

@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Barcode</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Apps</a></li>
                        <li class="breadcrumb-item active">Barcode</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Employee ID</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Employee Name</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>Select Designation</option>
                        <option>Web Developer</option>
                        <option>Web Designer</option>
                        <option>Android Developer</option>
                        <option>Ios Developer</option>
                    </select>
                    <label class="focus-label">Designation</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <!-- Search Filter -->


        <div class="row staff-grid-row">

            @foreach ($asset as $item)


                <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                    <div class="profile-widget">
                        <div class="profile-img">
                            <a href="">{!! QrCode::size(70)->generate($item->qr_code); !!}</a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                {{-- <a class="dropdown-item" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->generate($item->qr_code)) !!} "><i class="fa fa-download-o m-r-5" download></i> Download</a> --}}
                            </div>
                        </div>
                        <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html">{{ $item->fixed_assets_number }}</a></h4>
                        <div class="small text-muted">{{ $item->fixed_assets_description }}</div>
                        <div class="small text-muted">{{ $item->qr_code }}</div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>
    <!-- /Page Content -->


</div>
<!-- /Page Wrapper -->
@endsection




