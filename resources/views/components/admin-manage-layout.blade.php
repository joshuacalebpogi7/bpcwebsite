<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ $title ?? 'BPC Website' }}</title>
    {{-- favicon --}}
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">


    {{-- font-awesome icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    {{-- data tables --}}
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    {{-- data tables buttons --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    @stack('styles')

    @vite(['resources/css/appadmin.css'])
    @vite(['resources/js/app.js'])
    {{-- livewire style --}}
    @livewireStyles
</head>

<body>
    <!-- Admin header and navigation -->
    <header>
        <nav>
            <!-- Navigation menu -->
            <a href="/admin/dashboard">
                <h1>Admin Panel</h1>
            </a>
            {{-- @php
            dd((Request::is('admin/add-news') || (isset($news) && Request::is('admin/edit-news/' . $news->id . '/' .
            $news->title))));
            @endphp --}}
            @if (Request::is('admin/edit-profile'))
                <a href="/">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-admin') || Request::is('admin/edit-admin/*'))
                <a href="/admin/admins">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-alumni') || Request::is('admin/edit-alumni/*'))
                <a href="/admin/users">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-courses') || Request::is('admin/edit-courses/*'))
                <a href="/admin/courses">&laquo; Back</a>
            @endif
            @if (Request::is('admin/new_survey') || Request::is('admin/edit_survey/*'))
                <a href="/admin/surveys">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-news') || Request::is('admin/edit-news/*'))
                <a href="/admin/news">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-events') || Request::is('admin/edit-events/*'))
                <a href="/admin/events">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-gallery') || Request::is('admin/edit-album/*'))
                <a href="/admin/gallery">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-jobs') || Request::is('admin/edit-jobs/*'))
                <a href="/admin/jobs">&laquo; Back</a>
            @endif
            @if (Request::is('admin/new_forum') || Request::is('admin/edit_forum/*'))
                <a href="/admin/forums">&laquo; Back</a>
            @endif

        </nav>
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
        <!-- Main content for admin views -->
        <div class="container">
            {{ $slot }}
        </div>
    </div>

    {{-- livewire script --}}
    @livewireScripts
    {{-- sweetalert installed in laravel --}}
    @include('sweetalert::alert')
    {{-- jquery || always a must and on top --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- sweetalert script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/tinymce/tinymce.min.js"></script>

    @if (Request::is('admin/add-news') ||
            (isset($news) && Request::is('admin/edit-news/' . $news->id . '/' . $news->title)) ||
            Request::is('admin/add-events') ||
            (isset($events) && Request::is('admin/edit-events/' . $events->id . '/' . $events->title)) ||
            Request::is('admin/add-jobs') ||
            (isset($jobs) && Request::is('admin/edit-jobs/' . $jobs->id . '/' . $jobs->title)))
        @include('includes.img-preview')
    @endif

    @stack('scripts')
</body>

</html>
