<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Alumni Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="css/resetpass.css">
</head>
<body>
    <div class="wrapper">
        <div class="input-box">
            <input id="createPw" type="password" required>
            <label>Create password</label>
        </div>
        <div class="input-box">
            <input id="confirmPw" type="password" required>
            <label>Confirm password</label>
            <i class="fas fa-eye-slash show"></i>
        </div>
        <div class="alert">
            <i class="fas fa-exclamation-circle errorIcon"></i>
            <span class="text">Enter at least 8 characters</span>
        </div>
        <div class="input-box button">
            <input id="button" type="button" value="Reset" required>
        </div>
    </div>
    <script src="js/resetpass.js"></script>
</body>
</html>