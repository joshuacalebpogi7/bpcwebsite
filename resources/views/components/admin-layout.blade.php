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

    {{-- @vite(['resources/js/app.js']) --}}

    @livewireStyles

</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/">
                    <img src="/images/3.svg" alt="logo" style="height: 10rem; width: auto;" />
                </a>

                <a class="navbar-brand brand-logo-mini" href="/"><img src="/images/portal-logo-mini.svg"
                        alt="logo" style="height: 200px; width: auto;" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="ti-settings mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="ti-user mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
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
                            <a class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-flex">
                        <a class="nav-link" href="#">
                            <i class="icon-ellipsis"></i>
                        </a>
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
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section"
                            role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input"
                                        placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                            <p class="text-gray mb-0">The total number of sessions</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small
                                class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="/admin-dashboard/images/faces/face1.jpg"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="/admin-dashboard/images/faces/face2.jpg"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="/admin-dashboard/images/faces/face3.jpg"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="/admin-dashboard/images/faces/face4.jpg"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="/admin-dashboard/images/faces/face5.jpg"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="/admin-dashboard/images/faces/face6.jpg"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
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
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false"
                                aria-controls="ui-users">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title">Manage Users</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-users">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a
                                            class="nav-link @if (Request::is('admin/admins')) text-warning @endif"
                                            href="/admin/admins">Admins</a>
                                    </li>
                                    <li class="nav-item"> <a
                                            class="nav-link @if (Request::is('admin/users')) text-warning @endif"
                                            href="/admin/users">Alumni</a></li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-contents" aria-expanded="false"
                            aria-controls="ui-contents">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Manage Contents</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-contents">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/events')) text-warning @endif"
                                        href="/admin/events">Events</a>
                                </li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/news')) text-warning @endif"
                                        href="/admin/news">News</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/jobs')) text-warning @endif"
                                        href="/admin/jobs">Jobs</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/forums')) text-warning @endif"
                                        href="/admin/forums">Forums</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/surveys')) text-warning @endif"
                                        href="/admin/surveys">Surveys</a></li>
                                <li class="nav-item"> <a
                                        class="nav-link @if (Request::is('admin/gallery')) text-warning @endif"
                                        href="/admin/gallery">Gallery</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

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

    @include('includes.data-tables-script')
    @stack('scripts')




    {{-- datatables script --}}
    <script>
        $(document).ready(function() {
            // Common export options for all buttons
            var commonExportOptions = {
                columns: function(idx, data, node) {
                    // Check if the column contains "Action" or "Avatar" header, or if it's hidden
                    if (
                        node.innerHTML === "Action" ||
                        node.innerHTML === "Avatar" ||
                        node.innerHTML === "Thumbnail" ||
                        node.innerHTML === "Album Cover" ||
                        node.hidden
                    ) {
                        return false; // Exclude the column from export
                    }
                    return true; // Include the column in export
                }
            };

            var table = $('#example').DataTable({
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
                }],
                lengthChange: false
            });

            table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
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
