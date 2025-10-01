<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="border: 3px solid black;">
        <h2>Home Page</h2>
        <form action="/register" method="POST">
        @csrf
        <input type="text" placeholder="name">
        <input type="text" placeholder="email">
        <input type="password" placeholder="password">
        <button type="submit">Submit</button>
    </div>
</body>
</html>