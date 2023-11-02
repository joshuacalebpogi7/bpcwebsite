<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Jobs</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
    <!-- {{-- fonts --}} -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- @vite(['resources/css/job.css']) --}}
    @vite(['resources/css/bootstrap.min.css'])
    @vite(['resources/css/styles.css'])
    @vite(['resources/js/main.js'])

    @livewireStyles
</head>

<body style="background-color: #e9eef2">
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
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row gy-5 gx-4">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center mb-5">
                            <div class="text-start ps-4">
                                <h3 class="mb-3">{{ $job->job_title }}</h3>
                                <span class="text-truncate me-3"><i
                                        class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</span>
                                <span class="text-truncate me-3"><i
                                        class="far fa-clock text-primary me-2"></i>{{ $job->job_type }}</span>
                                <span class="text-truncate me-0"><i
                                        class="far fa-money-bill-alt text-primary me-2"></i>@php
                                            $salary = $job->salary;
                                            if ($salary >= 1000000) {
                                                $formattedSalary = '$' . number_format($salary / 1000000) . 'm';
                                            } elseif ($salary >= 1000) {
                                                $formattedSalary = '$' . number_format($salary / 1000) . 'k';
                                            } else {
                                                $formattedSalary = '$' . number_format($salary, 0, '', ',');
                                            }
                                        @endphp
                                    {{ $formattedSalary }}</span>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="mb-3">Job description</h4>
                            <p>{!! $job->description !!}</p>
                            <h4 class="mb-3">Responsibility</h4>
                            <p>{!! $job->responsibilities !!}</p>

                            <h4 class="mb-3">Qualifications</h4>
                            <p>{!! $job->requirements !!}</p>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4">Job Summary</h4>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Published On:
                                {{ $job->created_at->format('F j, Y') }}
                            </p>
                            {{-- <p><i class="fa fa-angle-right text-primary me-2"></i>Vacancy: 123 Position</p> --}}
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: {{ $job->job_type }}</p>
                            <p>
                                <i class="fa fa-angle-right text-primary me-2"></i> Salary:
                                ${{ number_format($job->salary, 0, '', ',') }}
                            </p>
                            <p>
                                <i class="fa fa-angle-right text-primary me-2"></i> Salary:
                                @php
                                    $salary = $job->salary;
                                    if ($salary >= 1000000) {
                                        $formattedSalary = '$' . number_format($salary / 1000000) . 'm';
                                    } elseif ($salary >= 1000) {
                                        $formattedSalary = '$' . number_format($salary / 1000) . 'k';
                                    } else {
                                        $formattedSalary = '$' . number_format($salary, 0, '', ',');
                                    }
                                @endphp
                                {{ $formattedSalary }}
                            </p>


                            <p><i class="fa fa-angle-right text-primary me-2"></i>Location: {{ $job->location }}</p>
                            @if (isset($job->link))
                                <p><i class="fa fa-angle-right text-primary me-2"></i>Company Website: <a
                                        href="{{ $job->link }}" target="_blank"
                                        rel="noopener noreferrer">{{ $job->link }}</a>
                                </p>
                            @endif

                            <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Status:
                                {{ $job->status }}</p>
                        </div>
                        <div class="col-12">
                            <div>
                                <form action="{{-- /submit-application/{{ $job->id }} --}}#" method="POST">
                                    @csrf
                                    <!-- Your form fields go here -->
                                    <a href="mailto:{{ $job->email }}"><button class="btn btn-primary w-100"
                                            type="submit">Apply Now</button></a>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
