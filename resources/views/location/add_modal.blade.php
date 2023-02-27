<!-- Add Location Modal -->
<div id="add_location" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('location.store') }}" method="POST" enctype="multipart/form-data">
                    {{-- <form action=""> --}}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Site</label>
                                <select class="select" id="site_id" name="site_id" required>
                                    @foreach ($site as $value)
                                        <option value="{{ $value->id }}">{{ $value->site_code }} -
                                            {{ $value->site_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Room</label>
                                <select class="select" id="room_id" name="room_id" required>
                                    @foreach ($room as $value)
                                        <option value="{{ $value->id }}">{{ $value->room_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location Code</label>
                                <input class="form-control" type="text" name="location_code" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Location Name</label>
                                <input class="form-control" type="text" name="location_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="form-control" name="location_remarks"></textarea>
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
<!-- /Add Location Modal -->
