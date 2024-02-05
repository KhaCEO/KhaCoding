<table>
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
