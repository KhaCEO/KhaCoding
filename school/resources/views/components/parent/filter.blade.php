<div class="offcanvas offcanvas-end bg-secondary" tabindex="-1" id="filterStudent"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Filter Students</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="get" id="FilterStudent">
            @csrf
            <h6 class="mb-3">Student Info</h6>
            <div class="mb-2">
                <label for="filter_fname" class="form-label">First Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="filter_fname" name="filter_fname">
            </div>
            <div class="mb-2">
                <label for="filter_lname" class="form-label">Last Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="filter_lname" name="filter_lname">
            </div>
            <div class="mb-2">
                <label for="filter_dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="filter_dob" name="filter_dob">
            </div>
            <div class="mb-2">
                <label for="filter_phone" class="form-label">Phone Number<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="filter_phone" name="filter_phone" maxlength="12">
            </div>
            <div class="mb-2">
                <label for="filter_gender" class="form-label">Gender</label>
                <select name="filter_gender" id="filter_gender" class="form-select">
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary btn-sm filterStudent">Filter</button>
        </form>
    </div>
</div>
