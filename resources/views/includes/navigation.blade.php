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
            <img src="pictures/logo.png" alt="" class="sidebar__logo-img">
            <p class="sidebar__logo-text">Bulacan Polytechnic College</p>
        </div>

        <div class="sidebar__content">
            <div class="sidebar__list">
                <a href="/" class="sidebar__link active-link">
                    <i class="ri-home-5-line"></i>
                    <span class="sidebar__link-name">Home</span>
                    <span class="sidebar__link-floating">Home</span>
                </a>

                <a href="#" class="sidebar__link">
                    <i class="ri-newspaper-line"></i>
                    <span class="sidebar__link-name">News</span>
                    <span class="sidebar__link-floating">News</span>
                </a>

                <a href="#" class="sidebar__link">
                    <i class="ri-calendar-event-line"></i>
                    <span class="sidebar__link-name">Events</span>
                    <span class="sidebar__link-floating">Events</span>
                </a>

                <a href="#" class="sidebar__link">
                    <i class="ri-briefcase-4-fill"></i>
                    <span class="sidebar__link-name">Jobs</span>
                    <span class="sidebar__link-floating">Jobs</span>
                </a>
            </div>

            <div class="sidebar__list">
                <a href="#" class="sidebar__link">
                    <i class="ri-team-fill"></i>
                    <span class="sidebar__link-name">Forum</span>
                    <span class="sidebar__link-floating">Forum</span>
                </a>

                <a href="#" class="sidebar__link">
                    <i class="ri-gallery-fill"></i>
                    <span class="sidebar__link-name">Gallery</span>
                    <span class="sidebar__link-floating">Gallery</span>
                </a>
            </div>

            <h3 class="sidebar__title">
                <span>Others</span>
            </h3>

            <div class="sidebar__list">
                <a href="/" class="sidebar__link">
                    <i class="ri-customer-service-fill"></i>
                    <span class="sidebar__link-name">Support</span>
                    <span class="sidebar__link-floating">Support</span>
                </a>

                <a href="#" class="sidebar__link">
                    <i class="ri-settings-3-line"></i>
                    <span class="sidebar__link-name">Settings</span>
                    <span class="sidebar__link-floating">Settings</span>
                </a>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="sidebar__link">
                        <i class="ri-logout-box-r-line"></i>
                        <span class="sidebar__link-name">Logout</span>
                        <span class="sidebar__link-floating">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="sidebar__account">
            <img src="pictures/gab.png" alt="sidebar image" class="sidebar__perfil">

            <div class="sidebar__names">
                <h3 class="sidebar__name">Gab Pogi</h3>
                <span class="sidebar__email">bpc@email.com</span>
            </div>

            <i class="ri-arrow-right-s-line"></i>
        </div>
    </nav>
</div>

<!--=============== MAIN ===============-->
<main class="main container" id="main">
    <h1></h1>
</main>

<!--=============== MAIN JS ===============-->
<script src="assets/js/main.js"></script>
