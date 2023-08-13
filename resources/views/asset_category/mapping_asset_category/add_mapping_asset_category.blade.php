<!-- Add Mapping Asset Category Modal -->
<div id="add_mapping" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Mapping Asset Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('map_ast_cat_save') }}" method="POST" enctype="multipart/form-data">
                    {{-- <form action=""> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Site</label>
                                <select class="select" id="site_code" name="site_code" required>
                                    <option value="">Pilih Site</option>
                                    @foreach ($sites as $value)
                                        <option value="{{ $value->id }}"> {{ $value->site_code }} -
                                            {{ $value->site_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Room</label>
                                <select class="select" id="location_id" name="location_id" required>
                                    {{-- <option value="">Pilih Room</option> --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Asset Category</label>
                                <select multiple data-allow-clear="1" class="select" id="asset_category_id"
                                    name="asset_category_id[]" required>
                                    @foreach ($asset_category as $value)
                                        <option value="{{ $value->id }}">{{ $value->asset_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="remarks_mapping_asset_category"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Mapping Asset Category Modal -->
