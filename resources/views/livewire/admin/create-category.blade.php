<div>
    {{-- form create category --}}
    <x-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Creaar nueva categoria
        </x-slot>

        <x-slot name="description">
            Complete la informacion necesaria para poder crear una categoria
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
                <x-label>
                    Icono
                </x-label>

                <x-input wire:model.defer="createForm.icon" type="text" class="w-full mt-1" /> 
                <x-input-error for="createForm.icon" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label>
                     Marca
                </x-label>
                
                <div class="grid grid-cols-4 text-lg">
                    @foreach ($brands as $brand)
                        <x-label>
                            <x-checkbox 
                             wire:model.defer="createForm.brands"
                             name="brands[]" 
                             value="{{$brand->id}}"/>
                            {{$brand->name}}
                        </x-label>
                    @endforeach
                </div>
                <x-input-error for="createForm.brands" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    Imagen
                </x-label>
                
                <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" id="{{$rand}}">
                <x-input-error for="createForm.image" />
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
    {{-- show all categories --}}
    <x-action-section>
        <x-slot name="title">
            Lista de categorias
        </x-slot>
        
        <x-slot name="description">
            Aqui encontra todas las categorias guardadas
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
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!!$category->icon!!}
                                </span>
                                <a href="{{route('admin.categories.show', $category)}}" class="uppercase underline hover:text-blue-600">
                                    {{$category->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$category->slug}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCategory', '{{$category->slug}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-action-section>
    {{-- edit categories --}}
    <x-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar categoria
        </x-slot>

        <x-slot name="content">
            <div class="space-y-3">

                <div>
                    @if ($editImage)
                        <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}" alt="">
                    @else
                        <img class="w-full h-64 object-cover object-center" src="{{Storage::url($editForm['image'])}}" alt="">
                    @endif
                </div>

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
                    <x-label>
                        Icono
                    </x-label>
    
                    <x-input wire:model.defer="editForm.icon" type="text" class="w-full mt-1" /> 
                    <x-input-error for="editForm.icon" />
                </div>
    
                <div>
                    <x-label>
                         Marca
                    </x-label>
                    
                    <div class="grid grid-cols-4 text-lg">
                        @foreach ($brands as $brand)
                            <x-label>
                                <x-checkbox 
                                 wire:model.defer="editForm.brands"
                                 name="brands[]" 
                                 value="{{$brand->id}}"/>
                                {{$brand->name}}
                            </x-label>
                        @endforeach
                    </div>
                    <x-input-error for="editForm.brands" />
                </div>
    
                <div>
                    <x-label>
                        Imagen
                    </x-label>
                    
                    <input wire:model="editImage" accept="image/*" type="file" class="mt-1" id="{{$rand}}">
                    <x-input-error for="editImage" />
                </div>
            </div>
        </x-slot>
      
        <x-slot name="footer">
            <x-danger-button
                wire:loading.attr="disabled" 
                wire:target="editImage, update" 
                wire:click="update"  
            >
                Actualizar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
