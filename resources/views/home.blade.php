<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Welcome back {{auth()->user()->name}}!</p>
    @else
    <p>Please register or log in.</p>
    @endauth
    <div style="border: 3px solid black;">
        <h2>Home Page</h2>
        <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button type="submit">Submit</button>
    </div>
</body>
</html>