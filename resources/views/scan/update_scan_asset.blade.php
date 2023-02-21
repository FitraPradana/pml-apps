@extends('layouts.main')

@section('title', 'Update Scanner Fixed Assets')

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
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title center">Update Data Scan Fixed Assets</h3>
                        </div>
                        <div class="mt-3 center">
                            @if ($asset->last_img_condition_stock_take)
                            <img src="{{ asset('storage/'. $asset->last_img_condition_stock_take) }}" class="inline-block" style="width:20%">
                            @else
                                <span class="badge badge-danger">Belum ada Foto</span>
                            @endif
                        </div><br><br>

                    </div>
                </div>
                <!-- /Page Header -->

                <form action="{{ route('update_scan_asset.update') }}" method="POST" enctype="multipart/form-data">
                {{-- <form action=""> --}}
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <input type="hidden" name="qr_code" value="{{ $asset->qr_code }}">
                        <input type="hidden" name="fixed_asset_id" value="{{ $asset->id }}">
                        <input type="hidden" name="last_img_condition_stock_take" value="{{ $asset->last_img_condition_stock_take }}">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fixed Asset Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{ $asset->fixed_assets_number }}" name="fixed_assets_number" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fixed Asset Group</label>
                                <input class="form-control " type="text" value="{{ $asset->fixed_assets_group }}" name="fixed_assets_group" readonly>
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
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Status Asset</label>
                                <select class="form-control select" @error('status_asset')
                                    is-invalid
                                @enderror name="status_asset" required>
                                    <option value="general" @selected(old('general', $asset->status_asset) == 'general')>General</option>
                                    <option value="good" @selected(old('good', $asset->status_asset) == 'good')>GOOD</option>
                                    <option value="need" @selected(old('need', $asset->status_asset) == 'need')>Need Repair / Need Replacement</option>
                                    <option value="dont_exist" @selected(old('dont_exist', $asset->status_asset) == 'dont_exist')>Dont Exist</option>
                                </select>
                                @error('status_asset')
                                <label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Site</label>
                                <select class="form-control select" @error('site_id')
                                    is-invalid
                                @enderror name="site_id" required>
                                @foreach ($site as $val)
                                    <option value="{{ $val->id }}" @if(old('site_id') == $val->id || $val->id == $asset->site_id) selected @endif>{{ $val->site_name }}</option>
                                @endforeach
                                </select>
                                @error('site_id')
                                <label style="color: red">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks_fixed_assets" id="remarks_fixed_assets" rows="3" class="form-control" @error('remarks_fixed_assets')
                                is-invalid
                            @enderror>{{ old('remarks_fixed_assets', $asset->remarks_fixed_assets) }}</textarea>
                                @error('remarks_fixed_assets')
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
                                    <img src="{{ asset('storage/'. $asset->last_img_condition_stock_take) }}" class="img-thumbnail" style="width:20%">
                                @else
                                    <span class="badge badge-danger">Belum ada Foto</span>
                                @endif
                                <input type="file" class="form-control" @error('last_img_condition')
                                is-invalid
                            @enderror id="last_img_condition" name="last_img_condition" accept="image/*">
                                @error('last_img_condition')
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

@if (session()->has('success'))
  <script type="text/javascript">
     swal({
         title:'Success!',
         text:"{{Session::get('success')}}",
         timer:5000,
         type:'success'
     }).then((value) => {
       //location.reload();
     }).catch(swal.noop);
 </script>
 @endif

@endsection