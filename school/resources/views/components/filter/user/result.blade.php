<table class="table">
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
