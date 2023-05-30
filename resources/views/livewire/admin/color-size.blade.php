<div class="mt-4">
    <div class=" bg-gray-100 shadow-lg rounded-lg p-6">
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
   
    @if ($size_colors->count())     
        <div class="mt-8">
            <table class="m-auto">
                <thead>
                    <tr>
                        <th class="px-4 p-2 w-1/3">Color</th>
                        <th class="px-4 p-2 w-1/3">Cantidad</th>
                        <th class="px-4 p-2 w-1/3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($size_colors as $size_color)
                        <tr wire:key="size_color-{{ $size_color->pivot->id }}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($size_color->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $size_color->pivot->quantity }} Unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <x-secondary-button class="ml-auto mr-2" wire:click="edit({{ $size_color->pivot->id }})"
                                    wire.loading.attr="disabled" wire:target="edit">
                                    Actualizar
                                </x-secondary-button>
                                <x-danger-button
                                    wire:click="$emit('deleteColorSize', {{$size_color->pivot->id}})"
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
</div>
