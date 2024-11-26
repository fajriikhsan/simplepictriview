<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box"></div>
        <img src="/image/logo.png" alt="logo">
        <header>Welcome to Simple Pict</header>

        <form action="{{ route('login') }}" method="POST" class="form">
            @csrf
            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" />
            </div>

            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" />
            </div>

            <button type="submit" class="loginbtn">Login</button>
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </form>
    </div>
</body>

</html>
