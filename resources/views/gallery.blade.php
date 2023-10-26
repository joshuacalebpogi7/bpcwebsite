<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Alumni Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    @vite(['resources/css/landingpage.css'])
    {{-- livewire style --}}
    @livewireStyles
</head>

<body style="margin-top: 8rem;">

    <header class="header">
        <div class="flex">
            <a href="/"><img src="images/logo.png" alt="BPC logo" class="logo"></a>
            <div class="logoname">ALUMNI <br><span>PORTAL</span></div>
            <nav class="navbar">
                <a href="/" class="">Home</a>
                <a href="/news" class="">News</a>
                <a href="/events" class="">Events</a>
                <a href="/gallery" class="">Gallery</a>
                @auth
                <a href="/edit-profile"><img title="My Profile" data-toggle="tooltip" data-placement="bottom"
                        style="width: 40px; border-radius: 50%; margin: 10px;" src="{{ auth()->user()->avatar }}" /></a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Sign Out</button>
                </form>
            @else
            </nav>
                <a href="/login">
                    <div class="icons">
                        <div id="user-btn" class="fas fa-user"></div>
                    </div>
                </a>
            @endauth
        
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
    </div>
    </header>

    <div class="container1">
        <div class="filterable_cards">

            <div class="card11" data-name="phone">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Phone</h6>
                    </div>
                </a>
            </div>

            <div class="card11" data-name="clothes">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Clothes</h6>
                    </div>
                </a>
            </div>

            <div class="card11" data-name="shoes">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Phone</h6>
                    </div>
                </a>
            </div>

            <div class="card11" data-name="shoes">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Shoe</h6>
                    </div>
                </a>
            </div>

            <div class="card11" data-name="phone">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Phone</h6>
                    </div>
                </a>
            </div>

            <div class="card11" data-name="phone">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Phone</h6>
                    </div>
                </a>
            </div>

            <div class="card11" data-name="phone">
                <a href="gallery-view-page.php"><img src="images/study-pic.jpg" alt="">
                    <div class="card11_body">
                        <h6 class="card11_title">Phone</h6>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <div class="copyrightText">
        <p>Copyright @ 2023 BPC Alumni Portal. All Rights Reserved.</p>
    </div>

    <script>
        let navbar = document.querySelector('.header .flex .navbar');

        document.querySelector('#menu-btn').onclick = () => {
            navbar.classList.toggle('active');
            profile.classList.remove('active');
        }
    </script>
</body>

</html>
