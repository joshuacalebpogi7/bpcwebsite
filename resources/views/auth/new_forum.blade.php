<x-home-layout>
    <x-slot name="title">
        Forums
    </x-slot>
    <link rel="stylesheet" type="text/css" href = "{{ asset('css/style.css') }}">
    @livewire('add-forum')
</x-home-layout>