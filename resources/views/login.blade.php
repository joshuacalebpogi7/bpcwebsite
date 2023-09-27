<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Login</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- {{-- bootstrap --}} -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>{{ $title ?? 'BPC Website' }}</title>
    <!-- {{-- fonts --}} -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    @vite(['resources/css/login.css'])

    @livewireStyles
</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">

                    <div class="text">
                        <h3>Welcome Home <h1>ALUMNI!</h1>
                        </h3>
                        <h4>"Let’s Go BPC"</h4>
                        </br></br>
                        <h2>Reconnect with us!</h2>
                    </div>

                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <img src="images/logo.png" alt="logo" class="logo" width="100px" height="100px">
                        <header>Bulacan Polytechnic College</header>
                        <p>Alumni Login</p>

                        <!-- form start -->
                        <form action="/login" method="POST">
                            @csrf
                            <div class="input-field">
                                <input value="{{ old('username_login') }}" type="text" class="input"
                                    name="username_login" id="username-login" required="">
                                @error('username_login')
                                    <p>{{ $message }}</p>
                                @enderror
                                <label for="username-login">Username</label>
                            </div>

                            <div class="input-field">
                                <input type="password" class="input" name="password_login" id="password-login"
                                    required="">
                                <label for="password-login">Password</label>
                                @error('password_login')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-field">
                                <button class="submit" type="submit">Log in</button>
                            </div>
                        </form>
                        <span><a href="/forgot-password">Forgot Password?</a></span>
                    </div>
                </div>
            </div>
        </div>
        <img src="/images/bg2.png" alt="shape-divider" class="background-image">
    </div>
</body>

</html>
