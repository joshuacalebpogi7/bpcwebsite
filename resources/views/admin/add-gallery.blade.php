<x-admin-layout>
    @livewire('add-gallery-form')
    @push('scripts')
        <script>
            window.addEventListener('beforeunload', function() {
                Livewire.emit('deleteTemporaryPhotos');
            });
        </script>
    @endpush

</x-admin-layout>
