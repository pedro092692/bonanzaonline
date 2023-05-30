<div class="container py-12">
    {{-- form create subcategory --}}
    <x-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Creaar nueva subcategoria
        </x-slot>

        <x-slot name="description">
            Complete la informacion necesaria para poder crear una subcategoria
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    Nombre
                </x-label>

                <x-input wire:model="createForm.name" type="text" class="w-full mt-1" /> 
                <x-input-error for="createForm.name" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    Slug
                </x-label>

                <x-input disabled wire:model="createForm.slug" type="text" class="w-full mt-1 bg-gray-100" /> 
                <x-input-error for="createForm.slug" />
            </div>

            
            <div class="col-span-6 sm:col-span-4">
                <div class="flex item-center">
                    <p>Esta subcategoria necesita especificar un peso?</p>
                    <div class="ml-auto">
                        <label>
                            <input wire:model.defer="createForm.weight" type="radio" name="weight" value="1">
                            Si
                        </label>
                        <label>
                            <input wire:model.defer="createForm.weight" type="radio" name="weight" value="0">
                            NO
                        </label>
                    </div>
                </div>
                <x-input-error for="createForm.weight" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex item-center">
                    <p>Esta subcategoria necesita especificar color?</p>
                    <div class="ml-auto">
                        <label>
                            <input wire:model.defer="createForm.color" type="radio" name="color" value="1">
                            Si
                        </label>
                        <label>
                            <input wire:model.defer="createForm.color" type="radio" name="color" value="0">
                            NO
                        </label>
                    </div>
                </div>
                <x-input-error for="createForm.color" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex item-center">
                    <p>Esta subcategoria necesita especificar talla?</p>
                    <div class="ml-auto">
                        <label>
                            <input wire:model.defer="createForm.size" type="radio" name="size" value="1">
                            Si
                        </label>
                        <label>
                            <input wire:model.defer="createForm.size" type="radio" name="size" value="0">
                            NO
                        </label>
                    </div>
                </div>
                <x-input-error for="createForm.size" />
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-6" on="saved">
                Categoria creada
            </x-action-message>
            <x-button>
                Agregar
            </x-button>
        </x-slot>
    </x-form-section>
    {{-- show subcategories --}}
    <x-action-section>
        <x-slot name="title">
            Lista de subcategorias
        </x-slot>
        
        <x-slot name="description">
            Aqui encontra todas las subcategorias guardadas
        </x-slot>
        
        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Accion</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td class="py-2">
                                <span class="uppercase">
                                    {{$subcategory->name}}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$subcategory->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteSubcategory', '{{$subcategory->id}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-action-section>
    
    {{-- edit subcategories --}}
    <x-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar subcategoria
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">

                <div>
                    <x-label>
                        Nombre
                    </x-label>
    
                    <x-input wire:model="editForm.name" type="text" class="w-full mt-1" /> 
                    <x-input-error for="editForm.name" />
                </div>
    
                <div>
                    <x-label>
                        Slug
                    </x-label>
    
                    <x-input disabled wire:model="editForm.slug" type="text" class="w-full mt-1 bg-gray-100" /> 
                    <x-input-error for="editForm.slug" />
                </div>

                <div>
                    <div class="flex item-center">
                        <p>Esta subcategoria necesita especificar un peso?</p>
                        <div class="ml-auto">
                            <label>
                                <input wire:model.defer="editForm.weight" type="radio" name="weight" value="1">
                                Si
                            </label>
                            <label>
                                <input wire:model.defer="editForm.weight" type="radio" name="weight" value="0">
                                NO
                            </label>
                        </div>
                    </div>
                    <x-input-error for="createForm.weight" />
                </div>
    
                <div>
                    <div class="flex item-center">
                        <p>Esta subcategoria necesita especificar color?</p>
                        <div class="ml-auto">
                            <label>
                                <input wire:model.defer="editForm.color" type="radio" name="color" value="1">
                                Si
                            </label>
                            <label>
                                <input wire:model.defer="editForm.color" type="radio" name="color" value="0">
                                NO
                            </label>
                        </div>
                    </div>
                    <x-input-error for="createForm.color" />
                </div>
    
                <div>
                    <div class="flex item-center">
                        <p>Esta subcategoria necesita especificar talla?</p>
                        <div class="ml-auto">
                            <label>
                                <input wire:model.defer="editForm.size" type="radio" name="size" value="1">
                                Si
                            </label>
                            <label>
                                <input wire:model.defer="editForm.size" type="radio" name="size" value="0">
                                NO
                            </label>
                        </div>
                    </div>
                    <x-input-error for="createForm.size" />
                </div>
    
            </div>
        </x-slot>
      
        <x-slot name="footer">
            <x-danger-button
                wire:loading.attr="disabled" 
                wire:target="update" 
                wire:click="update"  
            >
                Actualizar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

    @push('script')
        <script>
            livewire.on('deleteSubcategory', subcategoryId => {
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
                        Livewire.emitTo('admin.show-category', 'delete',  subcategoryId)
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
</div>
