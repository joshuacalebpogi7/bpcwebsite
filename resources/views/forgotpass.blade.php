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

            <div class="title-section">
                <h2 class="title">Reset Password</h2>
                <p class="para">Please verify your email before creating your account. Once you've completed this
                    step, you will receive a link in your inbox to set up your new password.</p>
            </div>

            <form action="/submit-forgot-password" class="from">
                <div class="input-group">
                    <label for="email" class="label-title">Enter Your Email</label>
                    <input type="email" name="forgot_email" placeholder="Enter your email" id="email">
                    <span class="icon">&#9993;</span>
                </div>

                <div class="input-group">
                    <button class="submit-btn" type="submit">Send Reset Email</button>
                </div>
            </form>

        </div>
    </div>
    <img src="images/bg2.png" alt="shape-divider" class="background-image">
</body>

</html>
