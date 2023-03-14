<!-- Add Custom Policy Modal -->
<div id="add_custom_policy" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Custom Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group leave-duallist">
                        <label>Add Document</label>
                        <div class="row">
                            <div class="col-lg-5 col-sm-5">
                                <select name="customleave_from" id="customleave_select" class="form-control"
                                    size="10" multiple="multiple">
                                    @foreach ($document as $val)
                                        <option value="{{ $val->id }}">{{ $val->voucher }} || {{ $val->invoice }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="multiselect-controls col-lg-2 col-sm-2">
                                {{-- <button type="button" id="customleave_select_rightAll"
                                    class="btn btn-block btn-white"><i class="fa fa-forward"></i></button> --}}
                                <button type="button" id="customleave_select_rightSelected"
                                    class="btn btn-block btn-white"><i class="fa fa-chevron-right"></i></button>
                                <button type="button" id="customleave_select_leftSelected"
                                    class="btn btn-block btn-white"><i class="fa fa-chevron-left"></i></button>
                                {{-- <button type="button" id="customleave_select_leftAll"
                                    class="btn btn-block btn-white"><i class="fa fa-backward"></i></button> --}}
                            </div>
                            <div class="col-lg-5 col-sm-5">
                                <select name="customleave_to" id="customleave_select_to" class="form-control"
                                    size="8" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="ket_pengajuan_pinjaman"></textarea>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Custom Policy Modal -->
