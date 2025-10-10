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