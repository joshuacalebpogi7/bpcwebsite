<x-admin-layout>
    <h1>Welcome {{ auth()->user()->username }} to Admin Dashboard</h1>

    {{-- @php
        dd(auth()->user()->jobs);
    @endphp --}}
</x-admin-layout>
