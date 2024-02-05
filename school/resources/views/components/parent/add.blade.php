<div class="offcanvas offcanvas-end bg-secondary" tabindex="-1" id="addParent"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Add New Parent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="post" id="formAddParent" enctype="multipart/form-data">
            @csrf
            <h6 class="mb-3">Parent Account</h6>
            <div class="mb-2">
                <label for="name" class="form-label">Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password<span class="text-danger"> *</span></label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <hr>
            <h6 class="mb-3">Parent Info</h6>
            <div class="mb-2">
                <label for="fname" class="form-label">First Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="fname" name="fname" required>
            </div>
            <div class="mb-2">
                <label for="lname" class="form-label">Last Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="lname" name="lname" required>
            </div>
            <div class="mb-2">
                <label for="profile" class="form-label">Profile</label>
                <input class="form-control" type="file" id="profile" name="profile">
            </div>
            <div class="mb-2">
                <label for="phone" class="form-label">Phone Number<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="phone" name="phone" maxlength="12" required>
            </div>
            <div class="mb-2">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select">
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary btn-sm saveParent">Save</button>
        </form>
    </div>
</div>
