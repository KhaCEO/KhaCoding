<div class="container-fluid pt-4 px-4">
    @include('errors._message')
    @include('components.subjects.add')
    @include('components.subjects.edit')
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4 dataUser">
                <div class="d-flex align-items-center justify-content-between">
                    <h6>List Class</h6>
                    <div class="d-md-flex ms-4 gap-2">
                        <div class="mb-2 input-group input-group-sm w-100">
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addSubjects">New
                                Subjects</button>
                        </div>
                    </div>
                </div>
                <table class="table" id="tableSubjects">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Subject Type</th>
                            <th scope="col">Create</th>
                            <th scope="col">Status</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>{{ $data->sub_name }}</td>
                                <td>{{ $data->sub_type }}</td>
                                <td>{{ $data->getUser->name }}</td>
                                <td>
                                    @if ($data->sub_status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>
                                    @if ($data->sub_delete == 1)
                                        Is Delete
                                    @else
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info btn-editSubjects"
                                        data-bs-toggle="modal" data-bs-target="#editSubjects"
                                        value="{{ $data->id }}">
                                        <i class="bi bi-pencil-square"></i>
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
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded p-4">
                <h6>List Class</h6>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($assSubjects as $data)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-danger">{{ $data->getClass->cr_name }}</h5>
                                    <p class="card-text text-success">{{ $data->getSub->sub_name }}</p>
                                    <p class="card-text text-info">{{ $data->getAssBy->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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

            // add subjects
            $(document).on("click", ".addNewSub", function(e) {
                e.preventDefault();
                var data = {
                    'sub_name': $('#sub_name').val(),
                    'sub_creat': $('#sub_create').val(),
                    'sub_type': $('#sub_type').val(),
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('add.subject') }}",
                    data: data,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 'success') {
                            $("#addSubjects").modal('hide');
                            $("#formAddSubjects")[0].reset();
                            $("#tableSubjects").load(location.href + " #tableSubjects");

                            Swal.fire({
                                icon: 'success',
                                title: 'Subjects added successfully',
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

            $(document).on("click", ".btn-editSubjects", function(e) {
                e.preventDefault();
                let subId = $(this).val();
                $('#editSubjectsID').val(subId);

                $.ajax({
                    type: "get",
                    url: "edit-subject/" + subId,
                    success: function(res) {
                        if (res.status == 200) {
                            $('#edit_sub_name').val(res.data.sub_name);
                            if (res.data.sub_status == 1) {
                                $('#edit_sub_status').val(res.data.sub_status).prop("checked",
                                    true);
                            }
                            if (res.data.sub_delete == 1) {
                                $('#edit_sub_delete').val(res.data.sub_delete).prop("checked",
                                    true);
                            }
                        }
                    }
                });
            });

            $(document).on("click", ".updateSubject", function(e) {
                e.preventDefault();

                let updateSubID = $('#editSubjectsID').val();
                let updateSubStatus = $('#edit_sub_status').is(':checked');
                let updateSubDeleted = $('#edit_sub_delete').is(':checked');

                var data = {
                    'sub_name': $('#edit_sub_name').val(),
                    'sub_status': updateSubStatus == true ? '1' : '0',
                    'sub_delete': updateSubDeleted == true ? '1' : '0',
                }
                $.ajax({
                    type: "put",
                    url: "update-subject/" + updateSubID,
                    data: data,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            $('#editSubjects').modal('hide');
                            $("#tableSubjects").load(location.href + " #tableSubjects");

                            Swal.fire({
                                icon: 'success',
                                title: 'Subjects update successfully',
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


        });
    </script>
@endsection
