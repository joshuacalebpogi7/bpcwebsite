<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ $title ?? 'Home' }}</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
    <!-- {{-- fonts --}} -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    @vite(['resources/css/style.css'])
    @vite(['resources/css/styles.css'])
    @vite(['resources/js/main.js'])
    @stack('assets')

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

                    <a href="/news" class="sidebar__link {{ request()->is('news') ? 'active-link' : '' }}">
                        <i class="ri-newspaper-line"></i>
                        <span class="sidebar__link-name">News</span>
                        <span class="sidebar__link-floating">News</span>
                    </a>

                    <a href="/events" class="sidebar__link {{ request()->is('events') ? 'active-link' : '' }}">
                        <i class="ri-calendar-event-line"></i>
                        <span class="sidebar__link-name">Events</span>
                        <span class="sidebar__link-floating">Events</span>
                    </a>

                    <a href="/jobs" class="sidebar__link {{ request()->is('jobs') ? 'active-link' : '' }}">
                        <i class="ri-briefcase-4-fill"></i>
                        <span class="sidebar__link-name">Jobs</span>
                        <span class="sidebar__link-floating">Jobs</span>
                    </a>
                </div>

                <div class="sidebar__list">
                    <a href="/forums" class="sidebar__link {{ request()->is('forums') ? 'active-link' : '' }}">
                        <i class="ri-team-fill"></i>
                        <span class="sidebar__link-name">Forum</span>
                        <span class="sidebar__link-floating">Forum</span>
                    </a>

                    <a href="/gallery" class="sidebar__link {{ request()->is('gallery') ? 'active-link' : '' }}">
                        <i class="ri-gallery-fill"></i>
                        <span class="sidebar__link-name">Gallery</span>
                        <span class="sidebar__link-floating">Gallery</span>
                    </a>

                    <a href="/survey" class="sidebar__link {{ request()->is('survey') ? 'active-link' : '' }}">
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

            <a href="/edit-profile" style="text-decoration: none; color: var(--white-color);">
                <div class="sidebar__account">
                    <img src="{{ auth()->user()->avatar }}" alt="sidebar image" class="sidebar__perfil">
                    <div class="sidebar__names">
                        <h3 class="sidebar__name">
                            {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                        </h3>
                        <span class="sidebar__email"
                            style="text-decoration: none; color: inherit;">{{ auth()->user()->email }}</span>
                    </div>
                    <i class="ri-arrow-right-s-line"></i>
                </div>
            </a>

        </nav>
    </div>



    <!--=============== MAIN ===============-->
    <main class="main container" id="main">
        {{ $slot }}
    </main>




    {{-- <div class="footer container5" style="margin: 5rem; auto; text-align:center">
        <p>&#169; ALUMNIPORTAL All Rights Reserved</p>
        <div class="social" style="margin:auto; text-align:center">
            <a href="#" style="font-size: 1.5rem;"><i class="ri-facebook-circle-fill"></i></a>
            <a href="#" style="font-size: 1.5rem;"><i class="ri-twitter-fill"></i></a>
            <a href="#" style="font-size: 1.5rem;"><i class="ri-instagram-fill"></i></a>
            <a href="#" style="font-size: 1.5rem;"><i class="ri-linkedin-box-fill"></i></a>
        </div>
    </div> --}}
    @livewireScripts
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- @stack('scripts') --}}
</body>

</html>
