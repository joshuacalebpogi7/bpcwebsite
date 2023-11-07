<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Events</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
    <!-- {{-- fonts --}} -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    @vite(['resources/css/style.css'])
    @vite(['resources/css/styles.css'])
    @vite(['resources/js/main.js'])
    @vite(['resources/css/events.css'])
    @vite(['resources/js/post.js'])
    <link rel="stylesheet" href='{{ asset('css/post.css') }}' rel='stylesheet'>
    {{-- @vite(['resources/css/post.css']) --}}

    @livewireStyles
</head>

<body>
    <!-- Sidebar bg -->

    <!--=============== HEADER ===============-->
    <header class="header">
        <div class="header__container container">
            <div class="header__toggle" id="header-toggle">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </header>

    <!--=============== SIDEBAR ===============-->
    <div class="sidebar" id="sidebar">
        <nav class="sidebar__container">
            <div class="sidebar__logo">
                <img src="/images/logo.png" alt="" class="sidebar__logo-img">
                <p class="sidebar__logo-text">Bulacan Polytechnic College</p>
            </div>

            <div class="sidebar__content">
                <div class="sidebar__list">
                    <a href="/" class="sidebar__link {{ request()->is('/') ? 'active-link' : '' }}">
                        <i class="ri-home-5-line"></i>
                        <span class="sidebar__link-name">Home</span>
                        <span class="sidebar__link-floating">Home</span>
                    </a>

                    <a href="/news" class="sidebar__link {{ request()->is('news*') ? 'active-link' : '' }}">
                        <i class="ri-newspaper-line"></i>
                        <span class="sidebar__link-name">News</span>
                        <span class="sidebar__link-floating">News</span>
                    </a>

                    <a href="/events" class="sidebar__link {{ request()->is('events*') ? 'active-link' : '' }}">
                        <i class="ri-calendar-event-line"></i>
                        <span class="sidebar__link-name">Events</span>
                        <span class="sidebar__link-floating">Events</span>
                    </a>

                    <a href="/jobs" class="sidebar__link {{ request()->is('jobs*') ? 'active-link' : '' }}">
                        <i class="ri-briefcase-4-fill"></i>
                        <span class="sidebar__link-name">Jobs</span>
                        <span class="sidebar__link-floating">Jobs</span>
                    </a>
                </div>

                <div class="sidebar__list">
                    <a href="/forums" class="sidebar__link {{ request()->is('forums*') ? 'active-link' : '' }}">
                        <i class="ri-team-fill"></i>
                        <span class="sidebar__link-name">Forum</span>
                        <span class="sidebar__link-floating">Forum</span>
                    </a>

                    <a href="/gallery" class="sidebar__link {{ request()->is('gallery*') ? 'active-link' : '' }}">
                        <i class="ri-gallery-fill"></i>
                        <span class="sidebar__link-name">Gallery</span>
                        <span class="sidebar__link-floating">Gallery</span>
                    </a>

                    <a href="/survey" class="sidebar__link {{ request()->is('survey*') ? 'active-link' : '' }}">
                        <i class="ri-survey-line"></i>
                        <span class="sidebar__link-name">Survey</span>
                        <span class="sidebar__link-floating">Survey</span>
                    </a>
                </div>

                <h3 class="sidebar__title">
                </h3>

                <div class="sidebar__list">
                    <a href="/logout" class="sidebar__link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-r-line"></i>
                        <span class="sidebar__link-name">Logout</span>
                        <span class="sidebar__link-floating">Logout</span>
                    </a>

                    <form action="/logout" method="POST" id="logout-form" style="display: none">
                        @csrf
                    </form>
                </div>
            </div>

            <a href="/edit-profile">
                <div class="sidebar__account">
                    <img src="{{ auth()->user()->avatar }}" alt="sidebar image" class="sidebar__perfil">

                    <div class="sidebar__names">
                        <h3 class="sidebar__name"> {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                        </h3>
                        <span class="sidebar__email">{{ auth()->user()->email }}</span>
                    </div>

                    <i class="ri-arrow-right-s-line"></i>
                </div>
            </a>
        </nav>
    </div>



    <!--=============== MAIN ===============-->
    <main class="main container" id="main">

    </main>

    <x-slot name="title">
        {{ $news->title }}
    </x-slot>



    <section class="post-header">
        <div class="header-content post-container">
            <a href="{{ URL::previous() }}" class="back-home">Back</a>
            <h1 class="header-title">{{ $news->title }}</h1>
            <img src="{{ $news->thumbnail }}" alt="" class="header-img"
                style="width: 100%; height: 25rem; object-fit: contain;">
        </div>
    </section>
    <section class="post-content post-container">
        <h2 class="sub-heading">{{ $news->title }}</h2>
        <p>
        <div class="post-text">{!! $news->description !!}</div>
        </p>
    </section>

    <div class="share post-container">
        <span class="share-title">Share this article</span>
        <div class="social">
            <a href="https://www.facebook.com/your_facebook_page"><i class="ri-facebook-circle-fill"></i></a>
            <a href="https://twitter.com/your_twitter_profile"><i class="ri-twitter-fill"></i></a>
            <a href="https://www.instagram.com/your_instagram_profile"><i class="ri-instagram-fill"></i></a>
            <a href="https://www.linkedin.com/in/your_linkedin_profile"><i class="ri-linkedin-box-fill"></i></a>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
