<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>
    <h2>Welcome <span>{{ auth()->user()->username }}</span> to HomePage!</h2>
</x-layout>
