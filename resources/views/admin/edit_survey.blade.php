{{-- <livewire:edit-survey :key="$refreshView" :survey_selected="$survey_selected"> --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit {{ $survey_selected->surveyTitle }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href = "{{ asset('css/form.css')}}">

    <!-- Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Scripts -->
    @livewireStyles
</head>

<body>
    @livewire('edit-survey', ['survey_selected' => $survey_selected])

    @livewireScripts
</body>

</html>
