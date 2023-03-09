@extends('layouts.main')

@section('title', 'Data Document')

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
                                <h3 class="page-title">Edit Data Document</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <form action="{{ route('document.update', $doc->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Voucher </label>
                                    <input class="form-control" type="text" value="{{ $doc->voucher }}" name="voucher"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Invoice</label>
                                    <input class="form-control " type="text" value="{{ $doc->invoice }}" name="invoice"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control " type="text" value="{{ $doc->description }}" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>PIC <span class="text-danger">*</span></label>
                                    <input class="form-control"
                                        @error('pic')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('pic', $doc->pic) }}" name="pic" required>
                                    @error('pic')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Status Document</label>
                                    <select class="form-control select"
                                        @error('status_doc')
                                    is-invalid
                                @enderror
                                        name="status_doc" disabled required>
                                        <option value="GENERAL" @selected(old('GENERAL', $doc->status_doc) == 'GENERAL')>General</option>
                                        <option value="TERSEDIA" @selected(old('TERSEDIA', $doc->status_doc) == 'TERSEDIA')>Tersedia</option>
                                        <option value="BELUM_TERSEDIA" @selected(old('BELUM_TERSEDIA', $doc->status_doc) == 'BELUM_TERSEDIA')>Belum Tersedia
                                        </option>
                                    </select>
                                    @error('status_doc')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Terima Document <span class="text-danger">*</span></label>
                                    <input class="form-control"
                                        @error('tgl_terima_doc')
                                    is-invalid
                                @enderror
                                        type="date" value="{{ old('tgl_terima_doc', $doc->tgl_terima_doc) }}"
                                        name="tgl_terima_doc" required>
                                    @error('tgl_terima_doc')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Lemari</label>
                                    <input class="form-control"
                                        @error('lemari')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('lemari', $doc->lemari) }}" name="lemari" required>
                                    @error('lemari')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Lorong</label>
                                    <input class="form-control"
                                        @error('lorong')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('lorong', $doc->lorong) }}" name="lorong" required>
                                    @error('lorong')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Baris</label>
                                    <input class="form-control"
                                        @error('baris')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('baris', $doc->baris) }}" name="baris" required>
                                    @error('baris')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>No Folder</label>
                                    <input class="form-control"
                                        @error('no_folder')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('no_folder', $doc->no_folder) }}" name="no_folder"
                                        required>
                                    @error('no_folder')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Keterangan Document</label>
                                    <input class="form-control"
                                        @error('ket_doc')
                                    is-invalid
                                @enderror
                                        type="text" value="{{ old('ket_doc', $doc->ket_doc) }}" name="ket_doc" required>
                                    @error('ket_doc')
                                        <label style="color: red">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
