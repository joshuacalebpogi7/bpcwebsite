<x-admin-manage-layout>
    @livewire('edit-gallery-form')
    <x-slot name="script">
        <script>
            window.addEventListener('beforeunload', function () {
                Livewire.emit('deleteTemporaryPhotos');
            });
        </script>
    </x-slot>

</x-admin-manage-layout>