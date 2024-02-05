<div class="modal fade" id="editClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
            </div>
            <form method="post" id="formEditClass" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editClassID">
                <ul class="errMsgEdit"></ul>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="cr_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_cr_name" name="cr_name">
                    </div>
                    <div class="mb-2 d-flex gap-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="cr_status" role="switch"  id="edit_cr_status">
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="cr_deleted" role="switch" id="edit_cr_deleted">
                            <label class="form-check-label">Delete</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm updateClass">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
