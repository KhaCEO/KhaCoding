</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD by Kha Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1969px-Laravel.svg.png"
                        alt="" width="40">
                    <span class="fs-4">Laravel CRUD by Kha Coding</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Features</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Enterprise</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Support</a>
                    <a class="py-2 text-dark text-decoration-none" href="#">Pricing</a>
                </nav>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4 dataUser">
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{ route('add') }}">
                                    <button type="button" class="btn btn-sm btn-info editStudent">
                                        Add
                                    </button>
                                </a>
                            </div>
                            <table class="table align-middle mt-2 mb-0" id="tableStudent">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                <a href="edit-user/{{ $data->id }}">
                                                    <button type="button" class="btn btn-sm btn-info">
                                                        Edit
                                                    </button>
                                                </a>
                                                <a href="delete-user/{{ $data->id }}">
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        Delete
                                                    </button>
                                                </a>
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
        </header>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>

</html>
