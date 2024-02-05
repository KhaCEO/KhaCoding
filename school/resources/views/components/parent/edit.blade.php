<div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <form method="post" id="formEditStudent" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editStudentID">
                <ul class="errMsgEdit"></ul>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="Upfname" class="form-label">First Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="Upfname" name="Upfname" required>
                    </div>
                    <div class="mb-2">
                        <label for="Uplname" class="form-label">Last Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="Uplname" name="Uplname" required>
                    </div>
                    <div class="mb-2">
                        <label for="Upprofile" class="form-label">Profile</label>
                        <input class="form-control" type="file" id="Upprofile" name="Upprofile">
                    </div>
                    <div class="mb-2">
                        <label for="Upemail" class="form-label">Email<span class="text-danger"> *</span></label>
                        <input type="email" class="form-control" id="Upemail" name="Upemail" required>
                    </div>
                    <div class="mb-2">
                        <label for="Updob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="Updob" name="Updob">
                    </div>
                    <div class="mb-2">
                        <label for="Upphone" class="form-label">Phone Number<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="Upphone" name="Upphone" maxlength="12" required>
                    </div>
                    <div class="mb-2">
                        <label for="Upgender" class="form-label">Gender</label>
                        <select name="Upgender" id="Upgender" class="form-select">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm updateStudent">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
