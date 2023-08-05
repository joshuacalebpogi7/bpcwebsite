<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>{{ $title ?? 'BPC Website' }}</title>
    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
    @livewireStyles
</head>

<body
    style="background-image: linear-gradient(to bottom, #007000cd, #ffffff4f), url('/images/bpc_building.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <header>
        <div>
            <nav class="nav justify-content-center">
                <div class="container-fluid">
                    <a href="/" class="text-light nav-link"><img src="/images/bpc_logo.png" alt="BPC logo"
                            class="img-fluid" width="80">ALUMNI
                        PORTAL</a>
                </div>
                <a href="/" class="text-light nav-link">Home</a>
                <a href="/news" class="text-light nav-link">News</a>
                <a href="/events" class="text-light nav-link">Events</a>
                <a href="/jobs" class="text-light nav-link">Jobs</a>
                <a href="/forums" class="text-light nav-link">Forums</a>
                <a href="/gallery" class="text-light nav-link">Gallery</a>
                @auth
                    <a href="/edit-profile"><img title="My Profile" data-toggle="tooltip" data-placement="bottom"
                            style="width: 40px; border-radius: 50%; margin: 10px;" src="{{ auth()->user()->avatar }}" /></a>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Sign Out</button>
                    </form>
                @else
                    <a href="/login" class="text-light"><i class="bi bi-person-circle" style="font-size: 1.5rem;"></i></a>
                @endauth

            </nav>
        </div>
    </header>

    @if (session()->has('accept'))
        <div class="container container-narrow">
            <div class="alert alert-success text-center">
                {{ session('accept') }}
            </div>
        </div>
    @endif

    @if (session()->has('reject'))
        <div class="container container-narrow">
            <div class="alert alert-danger text-center">
                {{ session('reject') }}
            </div>
        </div>
    @endif
    <div>
        {{ $slot }}

    </div>

    @include('sweetalert::alert')
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>
