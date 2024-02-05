<table class="table" id="tableClass">
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
            </tr>
        @endforeach
    </tbody>
</table>
