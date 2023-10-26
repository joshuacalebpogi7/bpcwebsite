<header class="header">
    <div class="flex">
        <a href="/"><img src="/images/logo.png" alt="BPC logo" class="logo"></a>
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
