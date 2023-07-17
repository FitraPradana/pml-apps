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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Information 3</label>
                                    <input class="form-control " type="text" value="{{ $asset->information3 }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select class="form-control select"
                                        @error('location_id')
                                    is-invalid
                                @enderror
                                        id="location_id" name="location_id" required>
                                        {{-- <option value="">-- Pilih Location --</option> --}}
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
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Status Asset</label>
                                    <select class="form-control select"
                                        @error('status_asset')
                                    is-invalid
                                @enderror
                                        name="status_asset" required>
                                        <option value="general" @selected(old('general', $asset->status_asset) == 'general')>General</option>
                                        <option value="good" @selected(old('good', $asset->status_asset) == 'good')>GOOD</option>
                                        <option value="need_replacement" @selected(old('need_replacement', $asset->status_asset) == 'need_replacement')>Need Replacement
                                        </option>
                                        <option value="need_repair" @selected(old('need_repair', $asset->status_asset) == 'need_repair')>Need Repair
                                        </option>
                                        <option value="dont_exist" @selected(old('dont_exist', $asset->status_asset) == 'dont_exist')>Dont Exist</option>
                                    </select>
                                    @error('status_asset')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Status Pakai</label>
                                    <select class="form-control select"
                                        @error('is_used')
                                    is-invalid
                                @enderror
                                        name="is_used" required>
                                        <option value="GENERAL" @selected(old('GENERAL', $asset->is_used) == 'GENERAL')>GENERAL</option>
                                        <option value="DIPAKAI" @selected(old('DIPAKAI', $asset->is_used) == 'DIPAKAI')>DIPAKAI</option>
                                        <option value="TIDAK_DIPAKAI" @selected(old('TIDAK_DIPAKAI', $asset->is_used) == 'TIDAK_DIPAKAI')>TIDAK DIPAKAI
                                        </option>
                                    </select>
                                    @error('is_used')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Upload Image</label><br>
                                    @if ($asset->last_img_condition_stock_take)
                                        <img src="{{ asset('storage/' . $asset->last_img_condition_stock_take) }}"
                                            class="img-thumbnail" style="width:20%">
                                    @else
                                        <span class="badge badge-danger">Belum ada Foto</span>
                                    @endif
                                    <input type="file" class="form-control"
                                        @error('last_img_condition')
                                is-invalid
                            @enderror
                                        id="last_img_condition" name="last_img_condition" accept="image/*">
                                    @error('last_img_condition')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks_fixed_assets" id="remarks_fixed_assets" rows="8" class="form-control" required
                                        @error('remarks_fixed_assets')
                                is-invalid
                            @enderror>{{ old('remarks_fixed_assets', $asset->remarks_fixed_assets) }}</textarea>
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


@section('under_body')
    <script type="text/javascript">
        $(function() {
            // SELECT2
            $('#location_id').select2({
                // width: '250'
            });
        });
    </script>

@endsection
