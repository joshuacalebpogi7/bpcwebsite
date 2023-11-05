<x-admin-layout>
    <x-slot name="title">
        Forums
    </x-slot>
@livewire('view-forum', ['forum_selected' => $forum_selected, 'authors' => $authors])
</x-admin-layout>