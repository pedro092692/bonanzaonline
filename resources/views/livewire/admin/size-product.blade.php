<div>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-12">
        <div>
            <x-label>
                Talla
            </x-label>
            <x-input type="text" placeholder="Ingresa una talla" class="w-full" wire:model="name" />
            <x-input-error for="name" />
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-button wire:click="save" wire.loading.attr="disabled" wire:target="save">
                Agreagar
            </x-button>

        </div>
    </div>

    <ul class="mt-12 space-y-4">
        @foreach ($sizes as $size)
            <li class="bg-white shadow-lg rounded-lg p-6" wire:key="size-{{ $size->id }}">
                <div class="flex items-center">
                    <span class="text-xl font-medium capitalize">
                        {{ $size->name }}
                    </span>
                    <div class="ml-auto">
                        <x-button wire:click="edit({{ $size->id }})" wire.loading.attr="disabled"
                            wier:target="edit({{ $size->id }})">
                            <i class="fas fa-edit"></i>
                        </x-button>
                        <x-danger-button
                                        wire:click="$emit('deleteSize', {{ $size->id }})">
                            <i class="fas fa-trash"></i>
                        </x-danger-button>
                    </div>
                </div>

                @livewire('admin.color-size', ['size' => $size], key('color-size' . $size->id))
            </li>
        @endforeach
    </ul>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar Talla
        </x-slot>

        <x-slot name="content">
            <x-label>
                Talla
            </x-label>

            <x-input type="Text" class="w-full" wire:model="name_edit" />

            <x-input-error for="name_edit" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="update" wire.loading.attr="disabled" wier:target="upadate">
                Actualizar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @push('script')
        {{-- <script>
            Livewire.on('deleteSize', sizeId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonweight: '#3085d6',
                    cancelButtonweight: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.size-product', 'delete', sizeId);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        </script> --}}
    @endpush
</div>
