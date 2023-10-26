<x-admin-layout :gallery="$gallery" :album="$album">
    @livewire('edit-gallery-form', ['gallery' => $gallery, 'album' => $album])
    @push('scripts')
        <script>
            window.addEventListener('beforeunload', function() {
                Livewire.emit('deleteTemporaryPhotos');
            });
            window.addEventListener('confirm-remove-photo', event => {


                Swal.fire({
                    title: 'Are you sure you want to remove this photo?',
                    text: 'This cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Emit the 'confirmRemovePhoto' event with the index as a parameter
                        Livewire.emit('confirmRemovePhoto');
                    }
                });
            });
        </script>
    @endpush

</x-admin-layout>
