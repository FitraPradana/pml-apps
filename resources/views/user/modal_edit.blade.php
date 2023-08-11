<!-- Edit User Modal -->
@foreach ($user as $key => $val)
    <div id="Edit_user{{ $val->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update', $val->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Personnel Number</label>
                                    <input class="form-control" name="personnel_number"
                                        value="{{ $val->personnel_number }}" type="text" required readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="username" value="{{ $val->username }}"
                                        type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" name="full_name" value="{{ $val->full_name }}"
                                        type="text" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" value="{{ $val->email }}"
                                        type="email" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="select" name="type" required disabled>
                                        {{-- <option value="general">General</option> --}}
                                        <option value="employee" @selected(old('employee', $val->type) == 'employee')>Employee</option>
                                        <option value="vessel" @selected(old('vessel', $val->type) == 'vessel')>Vessel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Roles</label>
                                    <select class="select" name="roles" required>
                                        <option value="admin" @selected(old('admin', $val->roles) == 'admin')>Administrator</option>
                                        <option value="user" @selected(old('user', $val->roles) == 'user')>User</option>
                                        <option value="vessel" @selected(old('vessel', $val->roles) == 'vessel')>Vessel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Active</label>
                                    <select class="select" name="active" required>
                                        <option value="yes" @selected(old('yes', $val->active) == 'yes')>Active</option>
                                        <option value="no" @selected(old('no', $val->active) == 'no')>Non Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="remarks_user">{{ $val->remarks_user }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- /Edit User Modal -->
