<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registrasi.css">
    <title>Registrasi</title>
</head>
<body>
   <div class="container" >
    <img src="image/logo.png" alt="logo" >
        <header>Registrasi</header>
        <form method="POST" action="{{ route('register') }}" class="form">
            @csrf <!-- Token CSRF wajib ada di setiap form POST di Laravel -->
            <div class="input-box">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" placeholder="Enter Full Name" required />
            </div>

            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username" required />
            </div>

            <div class="column">
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter Password" required />
                </div>
                <div class="input-box">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                </div>
            </div>
            
            <button type="submit" class="registerbtn">Register</button>
        </form>
   </div>
</body>
</html>
