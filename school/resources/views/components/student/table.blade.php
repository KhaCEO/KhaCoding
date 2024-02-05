<div class="container-fluid pt-4 px-4">
    @include('errors._message')
    @include('components.student.add')
    @include('components.student.edit')
    @include('components.student.filter')
    {{-- @include('components.classRoom.assign.assign') --}}
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4 dataUser">
                <div class="d-flex align-items-center justify-content-between">
                    <h6>List Students</h6>
                    <div class="d-md-flex gap-2">
                        <div class="mb-2">
                            <button class="btn btn-info btn-sm" data-bs-toggle="offcanvas"
                                data-bs-target="#filterStudent" aria-controls="addStudent">Filter</button>
                        </div>
                        <div class="mb-2">
                            <button class="btn btn-info btn-sm" data-bs-toggle="offcanvas"
                                data-bs-target="#addStudent" aria-controls="addStudent">New Students</button>
                        </div>
                    </div>
                </div>
                <table class="table align-middle mt-2 mb-0" id="tableStudent">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Status</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $data)
                            <tr>
                                <th>
                                    <img src="{{ asset('storage/images/'.$data->profile) }}" style="width: auto; height:100px" class="rounded">
                                </th>
                                <td>{{ $data->fname }} {{ $data->lname }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>{{ $data->dob }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info editStudent" data-bs-toggle="modal"
                                        data-bs-target="#editStudent" value="{{ $data->id }}">
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $(document).on("click", ".saveStudent", function(e) {
                e.preventDefault();
                let formData = new FormData($('#formAddStudent')[0])
                $.ajax({
                    type: "post",
                    url: "{{ route('add.student') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status == 200) {
                            $("#addStudent").offcanvas('hide');
                            $("#formAddStudent")[0].reset();
                            $("#tableStudent").load(location.href + " #tableStudent");

                            Swal.fire({
                            icon: 'success',
                            title: 'Student added successfully',
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

            $(document).on("click", ".editStudent", function(e) {
                e.preventDefault();
                let studentId = $(this).val();
                $('#editStudentID').val(studentId);

                $.ajax({
                    type: "get",
                    url: "edit-student/" + studentId,
                    success: function(res) {
                        if (res.status == 200) {
                            $('#Upfname').val(res.data.fname);
                            $('#Uplname').val(res.data.lname);
                            $('#Updob').val(res.data.dob);
                            $('#Upphone').val(res.data.phone);
                            $('#Upgender').val(res.data.gender);
                        }
                    }
                });
            });

            $(document).on("click", ".updateStudent", function(e) {
                e.preventDefault();
                let editStudentId = $("#editStudentID").val();
                let editFormData = new FormData($('#formEditStudent')[0])
                $.ajax({
                    type: "post",
                    url: "update-student/" + editStudentId,
                    data: editFormData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        if (res.status == 200) {
                            $("#editStudent").modal('hide');
                            $("#tableStudent").load(location.href + " #tableStudent");

                            Swal.fire({
                            icon: 'success',
                            title: 'Student updated successfully',
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
            $(document).on("click", ".filterStudent", function (e) {
                e.preventDefault();
                let filter_fname = $('#filter_fname').val();
                let filter_lname = $('#filter_lname').val();
                let filter_dob = $('#filter_dob').val();
                let filter_phone = $('#filter_phone').val();
                let filter_gender = $('#filter_gender').val();


                $.ajax({
                    type: "get",
                    url: "{{ route('filter.student') }}",
                    data: {
                        filter_fname: filter_fname,
                        filter_lname: filter_lname,
                        filter_dob: filter_dob,
                        filter_phone: filter_phone,
                        filter_gender: filter_gender,
                    },
                    success: function (res) {
                        $("tbody").html(res);
                        $("#filterStudent").offcanvas('hide');
                        $("#FilterStudent")[0].reset();

                        if(res.status == 400)
                        {
                            Swal.fire({
                            icon: 'warning',
                            title: 'Student Not Found',
                            text: "Don't have this user in system!",
                            }).then((res) => {
                                $("#tableStudent").load(location.href + " #tableStudent");
                            })

                        }

                    }
                });
            });


        });
    </script>
@endsection
