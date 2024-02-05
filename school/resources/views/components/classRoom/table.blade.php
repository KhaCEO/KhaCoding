<div class="container-fluid pt-4 px-4">
    @include('errors._message')
    @include('components.classRoom.add')
    @include('components.classRoom.edit')
    @include('components.classRoom.assign.assign')
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4 dataUser">
                <div class="d-flex align-items-center justify-content-between">
                    <h6>List Class</h6>
                    <div class="d-md-flex ms-4 gap-2">
                        <div class="mb-2 w-100">
                            <select name="cr_status" id="filter_status" class="form-select form-select-sm">
                                <option value="2">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-2 input-group input-group-sm w-100">
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addClass">New Class</button>
                        </div>
                    </div>
                </div>
                <table class="table" id="tableClass">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Deleted</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                            <th scope="col">Assign</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classRooms as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>{{ $data->cr_name }}</td>
                                <td>
                                    @if ($data->cr_status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>
                                    @if ($data->cr_deleted == 1)
                                        Is Delete
                                    @else

                                    @endif
                                </td>
                                <td>{{ $data->getUser->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info btn-editClass" data-bs-toggle="modal"
                                        data-bs-target="#editClass" value="{{ $data->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success btnAssign"
                                        data-bs-toggle="modal"
                                        data-bs-target="#assignSubject"
                                        value="{{ $data->id }}">
                                        Assign Subject
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$users->links()}} --}}
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $(document).on("click", ".addNewClass", function(e) {
                e.preventDefault();
                var data = {
                    'cr_name': $('#cr_name').val(),
                    'cr_created_by': $('#cr_create_by').val(),
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('add.class') }}",
                    data: data,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            $("#addClass").modal('hide');
                            $("#formAddClass")[0].reset();
                            $("#tableClass").load(location.href + " #tableClass");

                            Swal.fire({
                            icon: 'success',
                            title: 'Class Room added successfully',
                            })
                        }
                        // else if(res.status == 400)
                        // {
                        //     $('.errMsg').html("");
                        //     $('.errMsg').addClass('text-danger');
                        //     $.each(res.errors, function (key, err) {
                        //         $('.errMsg').append('<li>'+ err +'</li>');
                        //     });
                        // }
                    }
                });

            });

            $(document).on("click", ".btn-editClass", function (e) {
                e.preventDefault();
                let classId = $(this).val();
                $('#editClassID').val(classId);

                $.ajax({
                    type: "get",
                    url: "edit-class/" +classId,
                    success: function (res) {
                        if(res.status == 200)
                        {
                           $('#edit_cr_name').val(res.data.cr_name);
                           if(res.data.cr_status == 1)
                           {
                            $('#edit_cr_status').val(res.data.cr_status).prop("checked", true);
                           }
                           if(res.data.cr_deleted == 1)
                           {
                            $('#edit_cr_deleted').val(res.data.cr_deleted).prop("checked", true);
                           }
                        }
                    }
                });
            });

            $(document).on("click", ".updateClass", function (e) {
                e.preventDefault();

                let updateClassID = $('#editClassID').val();
                let updateStatus = $('#edit_cr_status').is(':checked');
                let updateDeleted = $('#edit_cr_deleted').is(':checked');

                var data = {
                    'cr_name' : $('#edit_cr_name').val(),
                    'cr_status' : updateStatus == true ? '1' : '0',
                    'cr_deleted' : updateDeleted == true ? '1' : '0',
                }
                $.ajax({
                    type: "put",
                    url: "update-class/" + updateClassID,
                    data: data,
                    dataType: "json",
                    success: function (res) {
                        if(res.status == 200)
                        {
                            $('#editClass').modal('hide');
                            $("#tableClass").load(location.href + " #tableClass");

                            Swal.fire({
                            icon: 'success',
                            title: 'Class Room update successfully',
                            })
                        }
                        else if(res.status == 400)
                        {
                            $('.errMsg').html("");
                            $('.errMsg').addClass('text-danger');
                            $.each(res.errors, function (key, err) {
                                $('.errMsg').append('<li>'+ err +'</li>');
                            });
                        }

                    }
                });

            });

            $("#filter_status").on("change", function (e) {
                e.preventDefault();
                let filterClass = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('filter.class') }}",
                    data: {
                        filterClass: filterClass,
                    },
                    success: function (res) {
                        $('tbody').html(res);
                        if(res.status == 400)
                        {
                            Swal.fire({
                            icon: 'warning',
                            title: 'Class Not Found',
                            text: "Don't have user with this role!",
                            }).then((res) => {
                                $("#tableClass").load(location.href + " #tableClass");
                            })

                        }

                    }
                });
            });

            $(document).on("click", ".btnAssign", function (e) {
                e.preventDefault();
                let subId = $(this).val();
                $('#classId').val(subId);
            });

            $(document).on("click", ".Assign", function (e) {
                e.preventDefault();
                var data = {
                    'class_id': $("#classId").val(),
                    'subject_id': $('.class-room-assign').val(),
                    'cr_created_by': $('#as_create_by').val(),
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('assign.subject') }}",
                    data: data,
                    dataType: "json",
                    success: function (res) {
                        if (res.status == 200) {
                            $("#assignSubject").modal('hide');
                            $("#formAssignSubject")[0].reset();

                            Swal.fire({
                            icon: 'success',
                            title: 'Subjects has assign to class is successfully',
                            })
                        }
                    }
                });
            });

        });
    </script>
@endsection
