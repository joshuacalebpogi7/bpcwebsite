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
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar" style="height: 100vh; margin: 0; position: fixed;">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <!-- Logo -->
                        <h2>Admin Panel</h2>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">
                                Admin Panel
                            </a>
                        </li> --}}
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">Home</a>
                        </li>
                        <!-- Manage dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/admin/edit-profile">Edit Profile</a>
                                <a class="dropdown-item" href="/admin/admins">Admins</a>
                                <a class="dropdown-item" href="/admin/users">Alumni</a>
                                <a class="dropdown-item" href="/admin/surveys">Survey</a>
                                <a class="dropdown-item" href="/admin/news">News</a>
                                <a class="dropdown-item" href="/admin/events">Events</a>
                                <a class="dropdown-item" href="/admin/gallery">Gallery</a>
                                <a class="dropdown-item" href="/admin/jobs">Jobs</a>
                                <a class="dropdown-item" href="/admin/forums">Forums</a>
                            </div>
                        </li>
                        <!-- Sign Out -->
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-danger nav-link" type="submit">Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content for admin views -->
            <main class="col-md-10 ms-sm-auto px-4">
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



                <!-- Main content for admin views -->
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </main>
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
    {{-- datatables --}}
    @include('includes.data-tables-script')
    {{-- sweetalert script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- datatables script --}}
    <script>
        $(document).ready(function() {
            // Common export options for all buttons
            var commonExportOptions = {
                columns: function(idx, data, node) {
                    // Check if the column contains "Action" or "Avatar" header, or if it's hidden
                    if (node.innerHTML === "Action" || node.innerHTML === "Avatar" || node.innerHTML ===
                        "Thumbnail" || node.innerHTML ===
                        "Album Cover" || node.hidden) {
                        return false; // Exclude the column from export
                    }
                    return true; // Include the column in export
                }
            };

            // Initialize DataTable with options
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: "excel",
                        orientation: "landscape",
                        text: "Export to Excel",
                        exportOptions: commonExportOptions,
                    },
                    {
                        extend: "pdf",
                        orientation: "landscape",
                        text: "Export to PDF",
                        exportOptions: commonExportOptions,
                    },
                    {
                        extend: "print",
                        orientation: "landscape",
                        text: "Print - Results",
                        exportOptions: commonExportOptions,
                    }
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [1, 2]
                }]
            });
        });
    </script>


    {{-- sweetalert script --}}
    <script>
        $('.deleteAlbum').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to delete this album?',
                text: 'All photos in this album will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, submit the form programmatically.
                    $(this).off('submit').submit();
                }
            });
        });

        $('.deleteNews').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to delete this news?',
                text: 'You cannot revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, submit the form programmatically.
                    $(this).off('submit').submit();
                }
            });
        });

        $('.deleteUser').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: 'You cannot revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, submit the form programmatically.
                    $(this).off('submit').submit();
                }
            });
        });
    </script>
</body>

</html>
