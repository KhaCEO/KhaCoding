<div class="container-fluid pt-4 px-4">
    @include('errors._message')
    @include('components.user.delete')
    @include('components.user.edit')
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4 dataUser">
                <div class="d-flex align-items-center justify-content-between">
                    <h6>All Users</h6>
                    <div class="d-md-flex ms-4 gap-2">
                        <div class="mb-2 input-group input-group-sm w-100">
                            <input type="email" class="form-control form-sm bg-dark border-0" id="sEmail" placeholder="Search by Email...">
                            <button class="btn btn-info btn-sm btnSearch">Search</button>
                        </div>
                        <div class="mb-2 w-75">
                            <select name="role" id="filter_role" class="form-select form-select-sm">
                                <option>Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Teacher</option>
                                <option value="3">Student</option>
                                <option value="4">Parent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table" id="table-data">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    @switch($data->user_role)
                                        @case(1)
                                            Admin
                                        @break

                                        @case(2)
                                            Teacher
                                        @break

                                        @case(3)
                                            Student
                                        @break

                                        @case(4)
                                            Parent
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-danger btn-deleteUser"
                                            data-bs-toggle="modal" data-bs-target="#userDelete" value="{{ $data->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-info btn-editUser" data-bs-toggle="modal"
                                            data-bs-target="#editUser" value="{{ $data->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-3">Add Users</h6>
                <form method="post" id="formAddUser" enctype="multipart/form-data">
                    @csrf
                    <ul class="errMsg"></ul>
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-2">
                        <label for="role" class="form-label">Assign Role</label>
                        <select name="role" id="role" class="form-select">
                            <option selected>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Teacher</option>
                            <option value="3">Student</option>
                            <option value="4">Parent</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-addUser">Add User</button>
                </form>
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

            // add user
            $(document).on("click", ".btn-addUser", function(e) {
                e.preventDefault();

                var data = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'password': $('#password').val(),
                    'role': $('#role').val(),
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('add.user') }}",
                    data: data,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 200) {
                            $("#formAddUser")[0].reset();
                            $("#table-data").load(location.href + " #table-data");

                            Swal.fire({
                            icon: 'success',
                            title: 'User Not Found',
                            text: "Don't have user with this role!",
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

            // delete user
            $(document).on("click", ".btn-deleteUser", function (e) {
                e.preventDefault();
                let userId = $(this).val();
                $('#userID').val(userId);
            });
            // confirm delete user
            $(document).on("click", ".confirmDelete", function (e) {
                e.preventDefault();
                let userIdDelete = $('#userID').val();

                $.ajax({
                    type: "post",
                    url: "delete-user/"+ userIdDelete, //delete-user/
                    data: userIdDelete,
                    success: function (res) {
                        if (res.status == "success") {
                            $("#userDelete").modal("hide");
                            $("#table-data").load(location.href + " #table-data");

                            Swal.fire({
                            icon: 'success',
                            title: 'User Not Found',
                            text: "Don't have user with this role!",
                            })
                        }
                    }
                });
            });

            // edit user
            $(document).on("click", ".btn-editUser", function (e) {
                e.preventDefault();
                let editUserId = $(this).val();
                $('#editUserID').val(editUserId);

                $.ajax({
                    type: "get",
                    url: "edit-user/"+ editUserId,
                    success: function (res) {
                        if(res.status == 200)
                        {
                            $('#edit_name').val(res.data.name);
                            $('#edit_email').val(res.data.email);
                            $('#edit_password').val(res.data.password);
                            $('#edit_role').val(res.data.user_role);
                        }
                    }
                });
            });

            // update user
            $(document).on("click", ".btn-updateUser", function (e) {
                e.preventDefault();
                let updateUserId = $('#editUserID').val();
                var data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                    'password': $('#edit_password').val(),
                    'role': $('#edit_role').val(),
                }

                $.ajax({
                    type: "put",
                    url: "update-user/"+ updateUserId,
                    data: data,
                    dataType: "json",
                    success: function (res) {
                        if(res.status == 200)
                        {
                            $("#editUser").modal('hide');
                            $("#table-data").load(location.href + " #table-data");

                            Swal.fire({
                            icon: 'success',
                            title: 'User Update Successfully',
                            text: "Account " + data.name + " has updated",
                            })
                        }
                        else if(res.status == 400)
                        {
                            $('.errMsgEdit').html("");
                            $('.errMsgEdit').addClass('text-danger');
                            $.each(res.errors, function (key, err) {
                                $('.errMsgEdit').append('<li>'+ err +'</li>');
                            });
                        }
                    }
                });
            });

            // filter user
            $("#filter_role").on("change", function (e) {
                e.preventDefault();
                let filterUser = $(this).val();

                $.ajax({
                    type: "get",
                    url: "{{ route('filter.user') }}",
                    data: {
                        filterUser: filterUser,
                    },
                    success: function (res) {
                        $('tbody').html(res);
                        if(res.status == 400)
                        {
                            Swal.fire({
                            icon: 'warning',
                            title: 'User Not Found',
                            text: "Don't have user with this role!",
                            }).then((res) => {
                                $("#table-data").load(location.href + " #table-data");
                            })

                        }

                    }
                });
            });

            $(document).on("click", ".btnSearch", function (e) {
                e.preventDefault();
                let sEmail = $('#sEmail').val();

                $.ajax({
                    type: "get",
                    url: "{{ route('search.user') }}",
                    data: {
                        sEmail: sEmail,
                    },
                    success: function (res) {
                        $('tbody').html(res);

                        if(res.status == 400)
                        {
                            Swal.fire({
                            icon: 'error',
                            title: sEmail + ' Not Found!',
                            text: "This Email don't have in system!",
                            }).then((res) => {
                                $("#table-data").load(location.href + " #table-data");
                            })

                        }
                    }
                });
            });


        });
    </script>
@endsection
