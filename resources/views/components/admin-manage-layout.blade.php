<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ $title ?? 'BPC Website' }}</title>
    {{-- favicon --}}
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    {{-- data tables --}}
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    {{-- data tables buttons --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

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
            @if (Request::is('admin/add-admin') || (isset($user) && Request::is('admin/edit-admin/*')))
            <a href="/admin/admins">&laquo; Back</a>
            @endif
            @if (Request::is('admin/add-alumni') || (isset($user) && Request::is('admin/edit-alumni/*')))
            <a href="/admin/users">&laquo; Back</a>
            @endif

            @if (Request::is('admin/add-survey') ||
            (isset($survey) && Request::is('admin/edit-survey/*')))
            <a href="/admin/surveys">&laquo; Back</a>
            @endif

            @if (Request::is('admin/add-news') || (isset($news) && Request::is('admin/edit-news/*')))
            <a href="/admin/news">&laquo; Back</a>
            @endif

            @if (Request::is('admin/add-events') ||
            (isset($events) && Request::is('admin/edit-events/*')))
            <a href="/admin/events">&laquo; Back</a>
            @endif

            @if (Request::is('admin/add-gallery') ||
            (isset($gallery) && Request::is('admin/edit-gallery/*')))
            <a href="/admin/gallery">&laquo; Back</a>
            @endif

            @if (Request::is('admin/add-jobs') || (isset($jobs) && Request::is('admin/edit-jobs/*')))
            <a href="/admin/jobs">&laquo; Back</a>
            @endif

            @if (Request::is('admin/add-forums') ||
            (isset($forums) && Request::is('admin/edit-forums/*')))
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
    <script>
        window.addEventListener('email-success', event => {
            Swal.fire({

                icon: 'success',
                title: 'Email sent successfully!',

            })
        });

        window.addEventListener('show-send-acc-details-confirmation', event => {
            Swal.fire({
                title: "Are you sure you want to send the account details to this email?",
                text: "Please confirm user's email!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('sendAccDetailsConfirmed');
                }
            })
        });
        //edit alumni form
        window.addEventListener('show-reset-profile-confirmation', event => {
            Swal.fire({
                title: 'Are you sure you want to reset the form?',
                text: "Your inputs will not be saved!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('resetProfileConfirmed');
                }
            })
        });

        window.addEventListener('show-allow-restricted-edit-confirmation', event => {
            Swal.fire({
                title: 'Are you sure you also want to edit user inputs?',
                text: "with great powers comes great responsibility!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I\'m Spiderman!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('allowRestrictedEditConfirmed');
                }
            })
        });

        window.addEventListener('show-reset-restricted-edit-confirmation', event => {
            Swal.fire({
                title: 'Are you sure you want to cancel?',
                text: "your inputs will not be saved!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('resetRestrictedEditConfirmed');
                }
            })
        });




        //add alumni form
        window.addEventListener('show-reset-alumni-form-confirmation', event => {
            Swal.fire({
                title: 'Reset the form?',
                text: "Your inputs will not be saved!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('resetAlumniFormConfirmed');
                }
            })
        });

        window.addEventListener('alumni-form-reset', event => {
            Swal.fire({
                title: 'Reset the form?',
                text: "Your inputs will not be saved!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
            })
        });

        window.addEventListener('show-course-delete-confirmation', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteCourseConfirmed');
                }
            })
        });

        window.addEventListener('course-deleted', event => {
            Swal.fire(
                'Deleted!',
                'Deleted successfully!',
                'success'
            )
        });

        window.addEventListener('course-error', event => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            })
        });

        window.addEventListener('course-success', event => {
            Swal.fire({

                icon: 'success',
                title: 'Course added successfully!',

            })
        });
    </script>
</body>

</html>