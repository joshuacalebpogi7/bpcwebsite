<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    @vite(['resources/css/resetpass.css'])
    @vite(['resources/js/resetpass.js'])
</head>

<body>
    <div class="wrapper">
        <h1>Reset Password</h1>
        <form action="{{ route('reset.password') }}" method="post" autocomplete="off">
            @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif

            @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            @csrf
            <div class="input-box">
                <input type="hidden" name="token" value="{{ $token }}">
            </div>
            <div class="input-box">
                <input type="email" name="email" value="{{ $email }}" hidden>
            </div>
            <div class="input-box">
                <input id="createPw" type="password" name="password" value="{{ old('password') }}" required>
                <label>Create password</label>
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div>
            <div class="input-box">
                <input id="confirmPw" type="password" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" required>
                <label>Confirm password</label>
                <i class="fas fa-eye-slash show"></i>
                <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
            </div>
            <div class="alert">
                <i class="fas fa-exclamation-circle errorIcon"></i>
                <span class="text">Enter at least 8 characters</span>
            </div>
            <div class="input-box button">
                <input id="button" type="submit" value="Reset password">
                {{-- <button type="submit">Reset password</button> --}}
            </div>
            <br>
            <a href="/login">Login</a>
    </div>

</body>

</html>