<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        {{-- Weight --}}
        <div class="mb-6">
            <x-label>
                Peso
            </x-label>
            <div class="grid grid-cols-6 gap-6">
                @foreach ($weights as $weight)
                    <label>
                        <input type="radio" name="weight_id" value="{{ $weight->id }}" wire:model.defer="weight_id">
                        <span class="ml-2 text-gray-700 capitalize">{{ __($weight->name) }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error for="weight_id" />
        </div>
        {{-- quantity --}}
        <div>
            <x-label>
                Cantidad de producto
            </x-label>
            <x-input type="number" wire:model.defer="quantity" min="1" placeholder="Ingresa una cantidad de producto"
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

    @if ($product_weights->count())     
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 p-2 w-1/6">Peso</th>
                        <th class="px-4 p-2 w-1/6">Cantidad</th>
                        <th class="px-4 p-2 w-1/6">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_weights as $product_weight)
                        <tr class="text-center" wire:key="product_weight-{{ $product_weight->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ $weights->find($product_weight->pivot->weight_id)->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $product_weight->pivot->quantity }} Unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-secondary-button class="ml-auto mr-2" wire:click="edit({{ $product_weight->pivot->id }})"
                                    wire.loading.attr="disabled" wire:target="edit">
                                    Actualizar
                                </x-secondary-button>

                                <x-danger-button
                                    wire:click="$emit('deleteWeight', {{ $product_weight->pivot->id }})"
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
            Editar Pesos
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label>
                    Peso
                </x-label>
                <select class="form-control w-full capitalize" wire:model="pivot_weight_id">
                    <option value="" selected disabled>Seleccione un weight</option>
                    @foreach ($weights as $weight)
                        <option value="{{ $weight->id }}">{{ __($weight->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-label>
                    Cantidad
                </x-label>
                <x-input type="number" placeholder="Ingresa una cantidad" class="w-full" wire:model="pivot_quantity" />
                <x-input-error for="pivot_quantity" />
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

    {{-- @push('script')
        <script>
            Livewire.on('deletePivot', pivot => {
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
                        Livewire.emitTo('admin.weight-product', 'delete', pivot);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })                
        </script>
    @endpush --}}
</div>