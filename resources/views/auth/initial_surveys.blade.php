<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey List</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href = "{{ asset('css/survey.css')}}">
    @livewireStyles
</head>
<body class="antialiased">
    <img src="/images/bg2.png" class="background-image">

    @livewire('survey-list') <!-- Include the Livewire component -->
    @livewireScripts
</body>
</html>