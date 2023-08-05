<script>
    window.addEventListener('show-reset-alumni-form-confirmation', event => {
        Swal.fire({
            title: 'Reset the form?',
            text: "Your inputs will not be saved!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('resetAlumniFormConfirmed');
            }
        })
    });

    window.addEventListener('alumni-form-reset', event => {
        Swal.fire({
            title: 'Reset the form?',
            text: "Your inputs will not be saved!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!'
        })
    });

    window.addEventListener('show-course-delete-confirmation', event => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteCourseConfirmed');
            }
        })
    });

    window.addEventListener('course-deleted', event => {
        Swal.fire(
            'Deleted!',
            'Deleted successfully!',
            'success'
        )
    });

    window.addEventListener('course-error', event => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        })
    });

    window.addEventListener('course-success', event => {
        Swal.fire({

            icon: 'success',
            title: 'Course added successfully!',

        })
    });
</script>
