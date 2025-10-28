<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Congrats you are logged in {{auth()->user()->name}}!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log Out</button>
    </form>
    <div style="border: 3px solid black;">
        <h2>Create a new post</h2>
        <form action="/create-post" method="POST">
        @csrf
        <input type='text' name='title' placeholder='title' value="{{ old('title') }}">
        @error('title')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <textarea name="body" placeholder="body Content">{{ old('body') }}</textarea>
        @error('body')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <button type="submit">Save Post</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <div style="background-color: lightgray; margin-bottom: 20px; padding: 10px;">
            <h3>{{$post->title}} by {{$post->user->name}} ({{$post->usersEmail()}})</h3>
            {{-- <p>by {{$post->user->name}}</p> --}}
            <p>{{$post->body}}</p>
            <p>Created at: {{$post->created_at}}</p>
            <p>Last updated: {{$post->updated_at}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit Post</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Post</button>
            </form>
            <hr>
        </div>
        @endforeach
    </div>


    @else
    <p>Please register or log in.</p>
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div style="border: 3px solid black;">
        <h2>Home Page</h2>
        <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button type="submit">Submit</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="/login" method="POST">
        @csrf
        <input name="loginname" type="text" placeholder="name">
        @error('loginname')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <input name="loginpassword" type="password" placeholder="password">
        @error('loginpassword')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <button type="submit">Submit</button>
        </form>
    </div>
    @endauth
</body>
</html>