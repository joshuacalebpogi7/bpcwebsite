<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Alumni Portal</title>
    @vite(['resources/css/login.css'])
</head>

<body>
    <div class="wrapper1">
        <div class="container1">
        <a href="/login"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="icon1"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path stroke-linecap="round" stroke-width="2" stroke="#4C4F5A" d="M6 6L18 18"></path> <path stroke-linecap="round" stroke-width="2" stroke="#4C4F5A" d="M18 6L6 18"></path> </g></svg></a>
            <div class="title-section">
                <h2 class="title">Reset Password</h2>
                <p class="para">Please verify your email before creating your account. Once you've completed this step, you will receive a link in your inbox to set up your new password.</p>
            </div>

            <form action="/submit-forgot-password" class="from" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email" class="label-title">Enter Your Email</label>
                    <input type="email" name="email" placeholder="Enter your email" id="email">
                    <span class="icon">&#9993;</span>
                </div>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
                @if (session('error'))
                    <p>{{ session('error') }}</p>
                @endif

                <div class="input-group">
                    <button class="submit-btn" type="submit">Send Reset Email</button>
                </div>
            </form>

        </div>
    </div>
    <img src="images/bg2.png" alt="shape-divider" class="background-image">
</body>

</html>
