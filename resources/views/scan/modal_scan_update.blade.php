<div id="updateScanModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Update Scan Barcode Asset</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ route('scanner.update') }}" method="post"> --}}
                <form>
                    {{-- @csrf
                    @method('PUT') --}}
                    <div class="center">
                        {{-- <img id="img_barcode" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('test')) !!} "> --}}

                        <img id="img_barcode" src="">
                    </div><br><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fixed Asset Number</label>
                                <input class="form-control" type="text" value="" id="fixed_assets_number" name="fixed_assets_number" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fixed Asset Group</label>
                                <input class="form-control " type="text" value="" id="fixed_assets_group" name="fixed_assets_group" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Fixed Asset Name</label>
                                <input class="form-control" type="text" value="" id="fixed_assets_name" name="fixed_assets_name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="profile-img-wrap edit-img">
                                <img src="assets/img/Fixed Assets/andromeda.jpg">
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Qr Code</label>
                                <input type="text" id="qrcode" class="form-control" value="">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select" id="status_asset" required>
                                    <option value="general"> General </option>
                                    <option value="good"> GOOD </option>
                                    <option value="need"> Need Repair / Need Replacement</option>
                                    <option value="dont_exist"> Dont Exist</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reports To <span class="text-danger">*</span></label>
                                <select class="select" id="pic" required>
                                    <option>-</option>
                                    <option>Wilmer Deluna</option>
                                    <option>Lesley Grauer</option>
                                    <option>Jeffery Lalor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks <span class="text-danger">*</span></label>
                                <textarea name="remarks_fixed_assets" id="remarks_fixed_assets" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
