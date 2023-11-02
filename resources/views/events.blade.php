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
    .container5 {
        padding-top: 120px;
    }

    #page-header {
        height: 25vh;
    }
</style>

<body style="margin-top: 5rem;">

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

    <section class="post container5">

        @foreach ($events as $eventItem)
            <div class="post-box {{ $eventItem->category }}">
                <img src="{{ $eventItem->thumbnail }}" alt="" class="post-img">
                <h2 class="category">{{ $eventItem->category }}</h2>
                <a href="/login" class="post-title">
                    {{ $eventItem->title }}
                </a>
                <span class="post-date">{{ $eventItem->created_at->format('F j, Y') }}</span>
                <p>
                <div class="post-description">
                    {!! $eventItem->description !!}
                </div>
                </p>

                <div class="profile">
                    <img src="{{ $eventItem->updatedBy->avatar }}" alt="" class="profile-img">
                    <span class="profile-name">{{ $eventItem->updatedBy->username }}</span>
                </div>
            </div>
        @endforeach

    </section>

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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="js/post.js"></script>
</body>

</html>
