<!-- Edit Employee Modal -->
@foreach ($employees as $key => $val)
    <div id="edit_employee{{ $val->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.update', $val->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Personnel Number <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" id="emp_accountnum" name="emp_accountnum"
                                        value="{{ $val->emp_accountnum }}" type="text" required readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="emp_name" name="emp_name"
                                        value="{{ $val->emp_name }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" id="emp_email" name="emp_email"
                                        value="{{ $val->emp_email }}" required readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Phone</label>
                                    <input class="form-control" type="text" id="emp_phone" name="emp_phone"
                                        value="{{ $val->emp_phone }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Address</label>
                                    <textarea class="form-control" name="emp_address">{{ $val->emp_address }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Position</label>
                                    <select class="select" id="position_id" name="position_id" required>
                                        <option value="">Pilih Position</option>
                                        @foreach ($positions as $value)
                                            <option value="{{ $value->id }}">{{ $value->dept_name }} -
                                                {{ $value->position_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room</label>
                                    <select class="select" id="room_id" name="room_id" required>
                                        @foreach ($positions as $value)
                                            <option value="{{ $value->id }}">{{ $value->dept_name }} -
                                                {{ $value->position_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Account</label>
                                    <select class="select" id="user_id_update" name="user_id">
                                        @foreach ($users as $usr)
                                            <option value="{{ $usr->id }}"
                                                @if (old('user_id_update') == $usr->id || $usr->id == $val->user_id) selected @endif>
                                                {{ $usr->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="select" id="department_id_update" name="department_id">
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}"
                                                @if (old('department_id_update') == $dept->id || $dept->id == $val->department_id) selected @endif>
                                                {{ $dept->dept_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label">Remarks</label>
                                    <textarea class="form-control" name="emp_remarks"></textarea>
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
@endforeach
<!-- /Edit Employee Modal -->
