<!-- Add Asset Modal -->
<div id="add_pengajuan" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Pengajuan Pinjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengajuan_pinjamans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Pengajuan</label>
                                <input class="form-control" name="kode_pengajuan_pinjaman" style="text-align: center;"
                                    value="{{ $nomer }}" type="text" readonly>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Document</label>
                                <select class="selectDoc" style="width: 100%;" name="document_id[]" multiple="multiple"
                                    required>
                                    @foreach ($document as $val)
                                        <option value="{{ $val->id }}">{{ $val->voucher }} || {{ $val->invoice }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="ket_pengajuan_pinjaman"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Asset Modal -->
