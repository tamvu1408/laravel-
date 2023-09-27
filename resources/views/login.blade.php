<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Login</h3>

    @if (session('login_error'))
    <span class="error">{{ session('login_error') }}</span>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email: </label>
            <input type="text" name="email">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>

</html>