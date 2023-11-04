<x-home-layout>
<link rel="stylesheet" href = "{{ asset('css/forum_post.css') }}"/>
    @livewire('view-forum', ['forum_selected' => $forum_selected])
</x-home-layout>