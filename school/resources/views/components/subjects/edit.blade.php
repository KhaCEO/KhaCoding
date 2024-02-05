<div class="modal fade" id="editSubjects" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
            </div>
            <form method="post" id="formEditSubjects" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editSubjectsID">
                <ul class="errMsgEdit"></ul>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="sub_name" class="form-label">Subjects Name</label>
                        <input type="text" class="form-control" id="edit_sub_name" name="sub_name">
                    </div>
                    <div class="mb-2 d-flex gap-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="sub_status" role="switch"  id="edit_sub_status">
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="sub_delete" role="switch" id="edit_sub_delete">
                            <label class="form-check-label">Delete</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm updateSubject">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
