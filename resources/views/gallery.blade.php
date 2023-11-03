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
            @foreach ($album as $album)
                <div class="card11" data-name="phone">
                    <a href="/login"><img src="{{ $album->album_cover }}" alt="">
                        <div class="card11_body">
                            <h6 class="card11_title">{{ $album->album_name }}</h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="sec aboutus">
                <h2>About Us</h2>
                <p>At Bulacan, we are committed to nurturing a thriving alumni community. Our Alumni Portal serves as a hub
                    for connections, stories, and growth. We celebrate the achievements of our alumni, providing a space to
                    network, share experiences, and continue our shared journey of excellence. Thank you for being an
                    essential part of our institution's legacy, and we look forward to writing the next chapter with you.
                </p>
                <ul class="sci">
                    <li><a href="https://www.facebook.com/bpc.edu.ph" target="blank"><i class="fab fa-facebook-f"></i></li></a>
                    <li><a href="#"><i class="fab fa-instagram"></i></li></a>
                    <li><a href="#"><i class="fab fa-youtube"></i></li></a>
                    <li><a href="https://bpc.edu.ph/"><i class="fas fa-globe"></i></li></a>
                </ul>
            </div>
            <div class="sec quicklinks">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="https://bpc.edu.ph/about-us/college-profile" target="blank">About</a></li>
                    <li><a href="https://bpc.edu.ph/" target="blank">FAQ</a></li>
                    <li><a href="https://bpc.edu.ph/" target="blank">Privacy Policy</a></li>
                    <li><a href="https://bpc.edu.ph/" target="blank">Help</a></li>
                    <li><a href="https://bpc.edu.ph/" target="blank">Terms & Conditions</a></li>
                    <li><a href="https://bpc.edu.ph/" target="blank">Contact</a></li>
                </ul>
            </div>
            <div class="sec contact">
                <h2>Contact Info</h2>
                <ul class="info">
                    <li>
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <span><a target = "_blank" href="https://maps.app.goo.gl/DixJD5Pyb9VKxCDPA">BPC Main Campus,
                                Bulihan, City of Malolos, <br>Bulacan, Philippines 3000</a></span>
                    </li>
                    <li>
                        <span><i class="fas fa-phone"></i></span>
                        <p><a href="tel:044-8026716">044-8026716</a></p>
                    </li>
                    <li>
                        <span><i class="fas fa-envelope"></i></span>
                        <p><a href="mailto:communications@bpc.edu.ph">communications@bpc.edu.ph</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
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
