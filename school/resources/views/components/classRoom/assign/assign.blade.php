<div class="modal fade" id="assignSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h5 class="modal-title">Add New Class</h5>
            </div>
            <ul class="errMsgEdit"></ul>
            <form method="post" id="formAssignSubject">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="as_create_by" id="as_create_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="class_id" id="classId">
                    <select class="class-room-assign form-select" name="subject_id[]" multiple="multiple">
                        @foreach ( $subjects as $data )
                        <option value="{{ $data->id }}">{{ $data->sub_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm Assign">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
