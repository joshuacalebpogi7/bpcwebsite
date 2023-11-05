<x-home-layout>
    <x-slot name="title">
        Forums
    </x-slot>
<link rel="stylesheet" href = "{{ asset('css/forum_post.css') }}"/>
    @livewire('reply-forum', ['forum_reply_selected' => $forum_reply_selected])
</x-home-layout>