<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Alumni Portal</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- {{-- bootstrap --}} -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <title>bpc website</title>
    <!-- {{-- fonts --}} -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
                
            <div class="col-md-6 side-image">
                
                <div class="text">
                    <h3>Welcome Home <h1>ALUMNI!</h1></h3>
                    <h4>"Let’s Go BPC"</h4>
                    </br></br><h2>Reconnect with us!</h2>
                </div>
                
            </div>
            <div class="col-md-6 right">
            <button type="button" class="dismiss">×</button> 
                <div class="input-box">
                <img src="pictures/logo.png" alt="logo" class="logo" width="100px" height="100px">
                   <header>Bulacan Polytechnic College</header>
                   <p>Alumni Login</p>
                   <div class="input-field">
                        <input type="text" class="input" id="email" required="" autocomplete="off">
                        <label for="email">Email</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="pass" required="">
                        <label for="pass">Password</label>
                    </div> 
                   <div class="input-field">
                        <input type="submit" class="submit" value="LOGIN">
                   </div> 
                   <span><a href="forgotpass.php">Forgot Password?</a></span>
                </div>  
            </div>
        </div>
    </div>
    <img src="pictures/bg2.png" alt="shape-divider" class="background-image">
</div>
</body>
</html>