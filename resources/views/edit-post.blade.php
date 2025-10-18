<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type='text' name='title' value="{{$post->title}}" placeholder='title'>
        <textarea name="body">{{$post->body}}</textarea>
        <button type="submit">Save Post</button>
    </form>
</body>
</html>