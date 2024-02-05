<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Image in Laravel</title>
</head>
<body>
    <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="image">Image: </label>
        <input type="file" name="image" id="image">
        <button type="submit">Upload Image</button>
    </form>
    <hr>
    @foreach ($image as $data )
    <img src="{{ asset('upload/'.$data->image) }}" alt="" width="490">
    @endforeach

</body>
</html>
