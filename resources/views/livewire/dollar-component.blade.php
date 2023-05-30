<div class="container py-12">
    {{-- from create/modify dollar price --}}
    <x-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Agregar el actual del dolar
        </x-slot>

        <x-slot name="description">
            En esta seccion se puede guardar y modificar el precio del dolar. 
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    Precio del dolar:
                </x-label>
                <x-input type="number" step="0.01" wire:model="createForm.price" class="w-full mt-1" />
                <x-input-error for="createForm.price" /> 
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button>
                Guardar
            </x-button>
        </x-slot>


    </x-form-section>

    {{-- show currencies information --}}
    <x-action-section>
        <x-slot name="title">
            Precio del dolar Guardado
        </x-slot>

        <x-slot name="description">
            Aqui puedes ver el precio del dolar actualmente recuerdar actulizar el precio a diario.
        </x-slot>

        <x-slot name="content">
            @if (!isset($dollar->value))
                <p class="text-center text-gray-700 text-lg font-semibold mt-4"><i class="fa-solid fa-sack-dollar mr-2"></i> Aun no se ha definido el precio del dolar. </p>
            @else
                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-1/3">Nombre Divisa</th>
                            <th class="py-2 w-1/3">Precio</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        <tr>
                            <td class="py-2">{{ __($dollar->name) }}</td>
                            <td class="py-2">{{$dollar->value}} Bs.</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </x-slot>
    </x-action-section>
</div>
