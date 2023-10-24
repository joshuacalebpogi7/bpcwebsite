<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Alumni Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href='https:/unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/landingpage.css'])
    @vite(['resources/css/events.css'])
    {{-- livewire style --}}
    @livewireStyles
</head>
<style>
  .container5{
    padding-top: 120px;
  }

  #page-header{
     height: 25vh;
  }
</style>
<body
    style="margin-top: 5rem;">

    <header class="header">
        <div class="flex">
            <a href="/"><img src="images/logo.png" alt="BPC logo" class="logo"></a>
                <div class="logoname">ALUMNI <br><span>PORTAL</span></div>
            <nav class="navbar">
                <a href="/" class="">Home</a>
                <a href="/news" class="">News</a>
                <a href="/events" class="">Events</a>
                <a href="/gallery" class="">Gallery</a>
            </nav>
                    <div class="icons">
                        <div id="menu-btn" class="fas fa-bars"></div>
                        <div id="times-btn" class="fas fa-times"></div>
                        <div id="user-btn" class="fas fa-user"></div>
                    </div>
            </nav>
        </div>
    </header>

    <section class="post container5">

        <div class="post-box mobile">
            <img src="images/bg.jpg" alt="" class="post-img">
            <h2 class="category">Mobile</h2>
            <a href="single-page-post.php" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet consectetur adispisicing</p>

            <div class="profile">
                <img src="images/gab.png" alt="" class="profile-img">
                <span class="profile-name">Marques Brown</span>
            </div>
        </div>

        <div class="post-box tech">
            <img src="images/prog-pic.jpg" alt="" class="post-img">
            <h2 class="category">Tech</h2>
            <a href="single-page-post.php" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet consectetur adispisicing</p>

            <div class="profile">
                <img src="images/gab.png" alt="" class="profile-img">
                <span class="profile-name">Marques Brown</span>
            </div>
        </div>

        <div class="post-box mobile">
            <img src="images/study-pic.jpg" alt="" class="post-img">
            <h2 class="category">Mobile</h2>
            <a href="single-page-post.php" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet consectetur adispisicing</p>

            <div class="profile">
                <img src="images/gab.png" alt="" class="profile-img">
                <span class="profile-name">Marques Brown</span>
            </div>
        </div>

        <div class="post-box design">
            <img src="images/bg.jpg" alt="" class="post-img">
            <h2 class="category">Design</h2>
            <a href="single-page-post.php" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet consectetur adispisicing</p>

            <div class="profile">
                <img src="images/gab.png" alt="" class="profile-img">
                <span class="profile-name">Marques Brown</span>
            </div>
        </div>

        <div class="post-box tech">
            <img src="images/prog-pic.jpg" alt="" class="post-img">
            <h2 class="category">Tech</h2>
            <a href="single-page-post.php" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet consectetur adispisicing</p>

            <div class="profile">
                <img src="images/gab.png" alt="" class="profile-img">
                <span class="profile-name">Marques Brown</span>
            </div>
        </div>

        <div class="post-box design">
            <img src="images/goal-pic.jpg" alt="" class="post-img">
            <h2 class="category">Design</h2>
            <a href="single-page-post.php" class="post-title">
                How To Create UX Design With Adobe XD
            </a>
            <span class="post-date">12 Feb 2022</span>
            <p class="post-description">Lorem ipsum dolor sit amet consectetur adispisicing</p>

            <div class="profile">
                <img src="images/gab.png" alt="" class="profile-img">
                <span class="profile-name">Marques Brown</span>
            </div>
        </div>
    </section>

    <div class="copyrightText">
      <p>Copyright @ 2023 BPC Alumni Portal. All Rights Reserved.</p>
    </div>


<script>
let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>
<script src="js/post.js"></script>
</body>
</html>
