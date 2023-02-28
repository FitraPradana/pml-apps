@extends('layouts.main')

@section('title', 'Data Fixed Assets')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Edit Data Fixed Assets</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <form action="{{ route('fixed_assets.update', $asset->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fixed Asset Number <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $asset->fixed_assets_number }}"
                                        name="fixed_assets_number" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fixed Asset Group</label>
                                    <input class="form-control " type="text" value="{{ $asset->fixed_assets_group }}"
                                        name="fixed_assets_group" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Fixed Asset Name</label>
                                    <input class="form-control" type="text" value="{{ $asset->fixed_assets_name }}"
                                        name="fixed_assets_name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Main Fixed Asset <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $asset->main_fixed_assets }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Vessel ID</label>
                                    <input class="form-control " type="text" value="{{ $asset->vessel_id }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Information 3</label>
                                    <input class="form-control " type="text" value="{{ $asset->information3 }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Acquisition Date</label>
                                    <input class="form-control"
                                        @error('acquisition_date')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('acquisition_date', $asset->acquisition_date) }}"
                                        name="acquisition_date" disabled required>
                                    @error('acquisition_date')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Net Book Value</label>
                                    <input class="form-control"
                                        @error('net_book_value')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('net_book_value', $asset->net_book_value) }}"
                                        name="net_book_value" required>
                                    @error('net_book_value')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Status Asset</label>
                                    <select class="form-control select"
                                        @error('status_asset')
                                    is-invalid
                                @enderror
                                        name="status_asset" required>
                                        <option value="general" @selected(old('general', $asset->status_asset) == 'general')>General</option>
                                        <option value="good" @selected(old('good', $asset->status_asset) == 'good')>GOOD</option>
                                        <option value="need" @selected(old('need', $asset->status_asset) == 'need')>Need Repair / Need Replacement
                                        </option>
                                        <option value="dont_exist" @selected(old('dont_exist', $asset->status_asset) == 'dont_exist')>Dont Exist</option>
                                    </select>
                                    @error('status_asset')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select class="form-control select"
                                        @error('location_id')
                                    is-invalid
                                @enderror
                                        name="location_id" required>
                                        @foreach ($location as $val)
                                            <option value="{{ $val->id }}"
                                                @if (old('location_id') == $val->id || $val->id == $asset->location_id) selected @endif>{{ $val->location_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <input class="form-control"
                                        @error('remarks_fixed_assets')
                                    is-invalid
                                @enderror
                                        type="text"
                                        value="{{ old('remarks_fixed_assets', $asset->remarks_fixed_assets) }}"
                                        name="remarks_fixed_assets" required>
                                    @error('remarks_fixed_assets')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
