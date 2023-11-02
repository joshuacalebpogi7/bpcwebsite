<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    {{-- favicon --}}
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    {{-- font-awesome icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin-dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin-dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-dashboard/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin-dashboard/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->

    @vite(['resources/js/app.js'])
    @stack('styles')
    @livewireStyles

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/">
                    <img src="/images/alumnilogoname.svg" alt="logo" style="height: 10rem; width: auto; padding:20px;" />
                </a>

                <a class="navbar-brand brand-logo-mini" href="/"><img src="/images/logo.png"
                        alt="logo" style="height: 50px; width: 50px;" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ auth()->user()->avatar }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a href="/admin/edit-profile" class="dropdown-item">
                                <i class="ti-user text-primary"></i>
                                Profile
                            </a>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="ti-power-off text-primary"></i>
                                    Logout
                                </button>
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item @if (Request::is('/') || Request::is('admin/dashboard')) active @endif">
                        <a class="nav-link" href="/admin/dashboard">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    @can('adminOnly')
                        <li class="nav-item @if (Request::is('admin/admins') ||
                                Request::is('admin/add-admin') ||
                                Request::is('admin/edit-admin*') ||
                                Request::is('admin/users') ||
                                Request::is('admin/add-alumni') ||
                                Request::is('admin/edit-alumni*') ||
                                Request::is('admin/courses') ||
                                Request::is('admin/add-courses') ||
                                Request::is('admin/edit-courses*')) active @endif">
                            <a class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false"
                                aria-controls="ui-users">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title">Manage Users</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-users">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a
                                            class="nav-link @if (Request::is('admin/admins') || Request::is('admin/add-admin') || Request::is('admin/edit-admin')) text-warning @endif"
                                            href="/admin/admins">Content Creator</a>
                                    </li>
                                    <li class="nav-item"> <a
                                            class="nav-link @if (Request::is('admin/users') || Request::is('admin/add-alumni') || Request::is('admin/edit-alumni*')) text-warning @endif"
                                            href="/admin/users">Alumni</a></li>
                                    <li class="nav-item"> <a
                                            class="nav-link @if (Request::is('admin/courses') || Request::is('admin/add-courses') || Request::is('admin/edit-courses*')) text-warning @endif"
                                            href="/admin/courses">Courses</a></li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    <li class="nav-item @if (Request::is('admin/events') ||
                            Request::is('admin/add-events') ||
                            Request::is('admin/edit-events*') ||
                            Request::is('admin/news') ||
                            Request::is('admin/add-news') ||
                            Request::is('admin/edit-news*') ||
                            Request::is('admin/jobs') ||
                            Request::is('admin/add-jobs') ||
                            Request::is('admin/edit-jobs*') ||
                            Request::is('admin/forums') ||
                            Request::is('admin/add-forums') ||
                            Request::is('admin/edit_forum*') ||
                            Request::is('admin/surveys') ||
                            Request::is('admin/new_survey') ||
                            Request::is('admin/edit_survey*') ||
                            Request::is('admin/gallery') ||
                            Request::is('admin/add-gallery') ||
                            Request::is('admin/edit-album*')) active @endif">
                        <a class="nav-link" data-toggle="collapse" href="#ui-contents" aria-expanded="false"
                            aria-controls="ui-contents">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Manage Contents</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-contents">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/events') || Request::is('admin/add-events') || Request::is('admin/edit-events*')) text-warning @endif"
                                        href="/admin/events">Events</a>
                                </li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/news') || Request::is('admin/add-news') || Request::is('admin/edit-news*')) text-warning @endif"
                                        href="/admin/news">News</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/jobs') || Request::is('admin/add-jobs') || Request::is('admin/edit-jobs*')) text-warning @endif"
                                        href="/admin/jobs">Jobs</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/forums') || Request::is('admin/add-forums') || Request::is('admin/edit_forum*')) text-warning @endif"
                                        href="/admin/forums">Forums</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/surveys') || Request::is('admin/new_survey') || Request::is('admin/edit_survey*')) text-warning @endif"
                                        href="/admin/surveys">Surveys</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/gallery') || Request::is('admin/add-gallery') || Request::is('admin/edit-album*')) text-warning @endif"
                                        href="/admin/gallery">Gallery</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->

            <div class="main-panel">
                <div class="content-wrapper" style="background-color: #F5FFF7 !important;">
                    @if (Request::is('admin/edit-profile'))
                        <a href="/">&laquo; Back</a>
                    @endif
                    @if (Request::is('admin/add-admin') || Request::is('admin/edit-admin/*'))
                        <a href="/admin/admins"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/add-alumni') || Request::is('admin/edit-alumni/*'))
                        <a href="/admin/users"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/add-courses') || Request::is('admin/edit-courses/*'))
                        <a href="/admin/courses"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/new_survey') || Request::is('admin/edit_survey/*'))
                        <a href="/admin/surveys"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/add-news') || Request::is('admin/edit-news/*'))
                        <a href="/admin/news"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/add-events') || Request::is('admin/edit-events/*'))
                        <a href="/admin/events"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/add-gallery') || Request::is('admin/edit-album/*'))
                        <a href="/admin/gallery"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/add-jobs') || Request::is('admin/edit-jobs/*'))
                        <a href="/admin/jobs"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    @if (Request::is('admin/view_forum/*') || Request::is('admin/new_forum') || Request::is('admin/edit_forum/*'))
                        <a href="/admin/forums"><button type="button" class="btn btn-primary btn-icon-text">
                            <i class="ti-angle-double-left btn-icon-prepend"></i>Back</button></a>
                    @endif
                    {{ $slot }}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
                            All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Group 3<i
                                class="ti-heart text-danger ml-1"></i></span>
                    </div>
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Alumni
                            Portal</span>
                    </div>
                </footer>
                <!-- partial -->

            </div>
        </div>
    </div>







    {{-- livewire script --}}
    @livewireScripts
    {{-- sweetalert installed in laravel --}}
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- plugins:js -->
    <script src="{{ asset('admin-dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin-dashboard/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-dashboard/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin-dashboard/js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin-dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin-dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin-dashboard/js/template.js') }}"></script>
    <script src="{{ asset('admin-dashboard/js/settings.js') }}"></script>
    <script src="{{ asset('admin-dashboard/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin-dashboard/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin-dashboard/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->

    @if (Request::is('admin/add-news') ||
            (isset($news) && Request::is('admin/edit-news/' . $news->id . '/' . $news->title)) ||
            Request::is('admin/add-events') ||
            (isset($events) && Request::is('admin/edit-events/' . $events->id . '/' . $events->title)) ||
            Request::is('admin/add-jobs') ||
            (isset($jobs) && Request::is('admin/edit-jobs/' . $jobs->id . '/' . $jobs->title)))
        @include('includes.img-preview')
    @endif
    <script src="/js/tinymce/tinymce.min.js"></script>
    @include('includes.data-tables-script')
    @stack('scripts')




    {{-- datatables script --}}
    <script>
        $(document).ready(function() {
            // Check if the table has the "users-table" class (replace with your actual class name)
            if ($('#userstable').hasClass('users-table')) {
                var userstable = $('#userstable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: "excel",
                            // orientation: "landscape",
                            // text: "Export to Excel",
                            exportOptions: {
                                columns: ':visible', // Export only visible columns
                            }
                        },
                        {
                            extend: "pdf",
                            orientation: "landscape",
                            // text: "Export to PDF",
                            exportOptions: {
                                columns: ':visible', // Export only visible columns
                            }
                        },
                        {
                            extend: "print",
                            orientation: "landscape",
                            // text: "Print - Results",
                            exportOptions: {
                                columns: ':visible', // Export only visible columns
                            }
                        },
                        {
                            extend: "csv",
                            // orientation: "landscape",
                            exportOptions: {
                                columns: ':visible', // Export only visible columns
                            }
                        },
                        'colvis', // ColVis button

                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [1, 2]
                    }],
                    lengthChange: false
                });

                userstable.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
            }
            /*             if ($('#example')) {
                            var table = $('#example').DataTable({
                                dom: 'Bfrtip',
                                buttons: [
                                    'colvis', // ColVis button

                                ],
                                columnDefs: [{
                                    orderable: false,
                                    targets: [1, 2]
                                }],
                                lengthChange: false
                            });


                            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
                        } */

            if ($('#example').length) {
                var table = $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis' // ColVis button
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [1, 2]
                    }],
                    lengthChange: false
                });

                table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

                // Update the search based on visible columns
                table.on('column-visibility.dt', function(e, settings, column, state) {
                    // Get an array of column indices for visible columns
                    var visibleColumns = table.columns(':visible').indexes().toArray();

                    // Clear the global search
                    table.search('').columns().search('');

                    // Apply the search to visible columns
                    table.columns(visibleColumns).search('').draw();
                });
            }


            if ($('#coursetable')) {
                var table = $('#coursetable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis', // ColVis button

                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [1]
                    }],
                    lengthChange: false
                });

                table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
            }
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
    <script>
        //edit alumni form
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
                text: "make sure to save your inputs!",
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
    </script>
</body>

</html>
