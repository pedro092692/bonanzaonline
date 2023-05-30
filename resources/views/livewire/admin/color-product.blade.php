<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        {{-- Color --}}
        <div class="mb-6">
            <x-label>
                Color
            </x-label>
            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" name="color_id" value="{{ $color->id }}" wire:model.defer="color_id">
                        <span class="ml-2 text-gray-700 capitalize">{{ __($color->name) }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error for="color_id" />
        </div>
        {{-- quantity --}}
        <div>
            <x-label>
                Cantidad de producto
            </x-label>
            <x-input type="number" wire:model.defer="quantity" placeholder="Ingresa una cantidad de producto"
                class="w-full" />
            <x-input-error for="quantity" />
        </div>
        <div class="flex justify-end items-center mt-4">
            <x-action-message class="mr-3" on="saved">
                Agregado
            </x-action-message>
            <x-button class="" wire:loading.attr="disabled" wire:target="save" wire:click="save">
                Agregar
            </x-button>
        </div>
    </div>

    @if ($product_colors->count())     
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 p-2 w-1/6">Color</th>
                        <th class="px-4 p-2 w-1/6">Cantidad</th>
                        <th class="px-4 p-2 w-1/6">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_colors as $product_color)
                        <tr class="text-center" wire:key="product_color-{{ $product_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($product_color->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $product_color->pivot->quantity }} Unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-secondary-button class="ml-auto mr-2" wire:click="edit({{ $product_color->pivot->id }})"
                                    wire.loading.attr="disabled" wire:target="edit">
                                    Actualizar
                                </x-secondary-button>

                                <x-danger-button
                                    wire:click="$emit('deletePivot', {{ $product_color->pivot->id }})"
                                    >
                                    Eliminar
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar Colores
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label>
                    Color
                </x-label>
                <select class="form-control w-full capitalize" wire:model="pivot_color_id">
                    <option value="" selected disabled>Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ __($color->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-label>
                    Cantidad
                </x-label>
                <x-input type="number" placeholder="Ingresa una cantidad" class="w-full" wire:model="pivot_quantity" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button class="mr-2" wire:click="$set('open', false)" wire.loading.attr="disable"
                wire:target="open">
                Cancelar
            </x-secondary-button>

            <x-button wire:click="update" wire.loading.attr="disable" wire:target="upadate">
                Actualizar
            </x-button>
        </x-slot>

    </x-dialog-modal>

    @push('script')
        {{-- <script>
            Livewire.on('deletePivot', pivot => {
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
                        Livewire.emitTo('admin.color-product', 'delete', pivot);
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
