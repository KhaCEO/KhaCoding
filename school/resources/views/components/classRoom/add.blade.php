<div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title">Add New Class</h5>
            </div>
            <ul class="errMsgEdit"></ul>
            <form method="post" id="formAddClass" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="hidden" id="cr_create_by" name="cr_create_by" value="{{ Auth::user()->id }}">
                        <label for="name" class="form-label">Class Name</label>
                        <input type="text" class="form-control" id="cr_name" name="cr_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm addNewClass">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
