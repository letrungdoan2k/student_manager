<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="profile-form-update" id="profileSubmit" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Profile</h5>
                    <button type="button" class="close" onclick="hideModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="form-group col-md-6">
                            <label for="inputNam4">Họ và Tên</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   data-rule="required" placeholder="Name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputBirthday4">Birthday</label>
                            <input class="form-control" name="birthday"
                                   type="date"
                                   data-rule="required|date" id="example-date-input">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputBirthday4">Gender</label>
                            <select name="gender" id="inputState" data-rule="required"
                                    class="form-control">
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputemail2">Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   data-rule="required|email" placeholder="example@gmal.com">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone2">Phone Number</label>
                            <input type="number" name="phone"
                                   class="form-control"
                                   data-rule="required|checkPhone" placeholder="phone number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Address</label>
                            <input type="text" name="address"
                                   class="form-control"
                                   data-rule="required">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="avatar">Avatar</label>
                            <input type="file" id="updateProfileAvata" name="avatar" class="form-control">
                            <small id="fileHelp" class="form-text text-muted">File phải có định dạng png
                                hoặc
                                jpg.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideModal()">Close</button>
                    <button type="submit" class="btn btn-primary btn-submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" id="idStudentHidden">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete student</h5>
                <button type="button" class="close" onclick="hideConfirmDelete()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-confirm-delete">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hideConfirmDelete()">Close</button>
                <button type="button" onclick="onSubmitDelete()" class="btn btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>
<div id="myModalSubject" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['method' => 'PUT', 'class' => 'subject-form-update']) !!}
                <input type="hidden" name="register" value="register">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Register Subject</h5>
                    <button type="button" class="close" onclick="hideModalSubject()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-subject">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            Subject:
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" class="btn btn-primary btn-submit" id="addSubjectModal">Add</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideModalSubject()">Close</button>
                    <button type="submit" class="btn btn-primary btn-submit">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div id="myModalPermission" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['method' => 'PUT', 'id' => 'formPermission']) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Permission</h5>
                <button type="button" class="close" onclick="hideModalPermission()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-subject">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Permission:</label>
                        <select name="permission" ata-rule="required"
                                class="form-control">
                            <option value="member">member</option>
                            <option value="staff">staff</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hideModalPermission()">Close</button>
                <button type="submit" class="btn btn-primary btn-submit">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
