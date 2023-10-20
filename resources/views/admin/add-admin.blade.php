<x-admin-manage-layout :user="$user">
    @livewire('add-admin-form')

    @push('scripts')
        <script>
            window.addEventListener('show-role-delete-confirmation', event => {
                Swal.fire({
                    title: 'Are you sure you want to delete this role?',
                    text: "Every user who have this role will also be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteRoleConfirmed');
                    }
                })
            });

            window.addEventListener('role-deleted', event => {
                Swal.fire(
                    'Role Deleted!',
                    'Deleted successfully!',
                    'success'
                )
            });

            window.addEventListener('role-error', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            });

            //adding admins
            window.addEventListener('show-reset-admin-form-confirmation', event => {
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
                        Livewire.emit('resetAdminFormConfirmed');
                    }
                })
            });

            window.addEventListener('show-add-admin-confirmation', event => {
                Swal.fire({
                    title: 'Are you sure you want to add this admin?',
                    text: "Account will be sent to this admin's email",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('adminConfirmed');
                    }
                })
            });

            window.addEventListener('alumni-added', event => {
                Swal.fire({

                    icon: 'success',
                    title: 'Alumni added successfully!',
                    text: "Account details has been emailed to this user!",

                })
            });
        </script>
    @endpush
</x-admin-manage-layout>
