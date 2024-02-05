<div class="modal fade" id="addSubjects" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title">Add New Subjects</h5>
            </div>
            <ul class="errMsgEdit"></ul>
            <form method="post" id="formAddSubjects" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="hidden" id="sub_create" name="sub_create" value="{{ Auth::user()->id }}">
                        <label for="name" class="form-label">Subjects Name</label>
                        <input type="text" class="form-control" id="sub_name" name="sub_name">
                    </div>
                    <div class="mb-2 w-100">
                        <select name="sub_type" id="sub_type" class="form-select form-select-sm">
                            <option>Subjects Type</option>
                            <option value="Computer">Computer</option>
                            <option value="Desgin">Desgin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm addNewSub">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
