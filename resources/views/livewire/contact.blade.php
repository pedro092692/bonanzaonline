<div class="container px-4 py-6" x-data="{ subject: @entangle('subject') }">
    {{-- form contact us --}}
    <x-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Pongámonos en contacto
            @auth
                {{auth()->user()->name}}
            @endauth
        </x-slot>

        <x-slot name="description">
            Complete la informacion necesaria para poder atenderlo y ponernos en contacto.
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    ¿Por qué quiere ponerse en contacto con nosotros?
                </x-label>

                <x-input wire:model="createForm.reason" type="text" class="w-full mt-1" /> 
                <x-input-error for="createForm.reason" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                @if (!auth()->user())
                    <x-label>
                        Correo
                    </x-label>

                    <x-input wire:model="createForm.email" type="email" class="w-full mt-1" /> 
                    <x-input-error for="createForm.email" />
                    
                @endif
            </div>

            <div class="col-span-6 sm:col-span-4">
                @if (!auth()->user())
                    <x-label>
                        Nombre
                    </x-label>

                    <x-input wire:model="createForm.name" type="text" class="w-full mt-1" /> 
                    <x-input-error for="createForm.name" />
                    
                @endif
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    Asunto
                </x-label>

                <select wire:model="createForm.subject" x-model="subject" class="form-control w-full">
                    <option value="">Selecciona un asunto</option>
                    <option value="1">Mas informacion sobre un producto</option>
                    <option value="2">Tengo un problema con un pago</option>
                    <option value="3">Trabajo</option>
                    <option value="4">Soy un proveedor</option>
                    <option value="5">Otros</option>
                </select>

                
                <x-input-error for="createForm.subject" />
            </div>

            <div class="col-span-6 sm:col-span-4 hidden" :class="{ 'hidden': subject  != 2  }">

                <x-label class="mt-4">
                    N. orden
                </x-label>
                
                <x-input wire:model="createForm.order" type="text" class="w-full mt-1" /> 
                <x-input-error for="createForm.order" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label>
                     Mensaje
                </x-label>

                <textarea wire:model="createForm.message" rows="4"  class="form-control w-full resize-none"></textarea>
                
                <x-input-error for="createForm.message" />
            </div>
                
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-6" on="saved">
                Mensaje enviado nos comunicaremos lo mas pronto posible
            </x-action-message>
            <x-button>
                Enviar
            </x-button>
        </x-slot>
    </x-form-section>
</div>
