<x-admin-layout>
    <div class="container py-12">
        @livewire('admin.create-category')
    </div>

    @push('script')
        <script>
            livewire.on('deleteCategory', categorySlugh => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonweight: '#3085d6',
                    cancelButtonweight: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    Livewire.emitTo('admin.create-category', 'delete', categorySlugh)
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</x-admin-layout>
