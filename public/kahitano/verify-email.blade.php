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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
    <!-- {{-- fonts --}} -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
    @vite(['resources/js/design.js'])
    {{-- livewire style --}}
    @livewireStyles

</head>

<body
    style="background-image: linear-gradient(180deg, rgba(0,165,111,0.6) 100%, rgba(2,25,19,0.865983893557423) 100%), url('/images/bg.jpg');">
    @include('includes.header')

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
    <div class="container" style="margin-top: 15rem;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>{{ __('Email Verification') }}</h4></div>
                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="card-footer text-right">
                            <button class="btn btn-success">
                                {{ __('click here to request another') }}
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>