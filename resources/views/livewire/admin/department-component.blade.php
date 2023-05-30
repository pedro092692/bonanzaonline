<div class="container py-12">
    {{-- add new department --}}
    <x-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Agregar un nuevo estado
        </x-slot>
        <x-slot name="description">
            Completa la informacion para poder agragar un nuevo estado
        </x-slot>
        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label>
                    Nombre
                </x-label>
                <x-input type="text" wire:model.defer="createForm.name" class="w-full mt-1" />
                <x-input-error for="createForm.name" />
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                Estado agreagado
            </x-action-message>
            <x-button>
                Agregar
            </x-button>
        </x-slot>
    </x-form-section>

     {{-- show all departments --}}
     <x-action-section>
        <x-slot name="title">
            Lista de Estados
        </x-slot>
        
        <x-slot name="description">
            Aqui encontra todos los estados guardadas
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
                    @foreach ($departments as $department)
                        <tr>
                            <td class="py-2">
                                <a href="{{route('admin.departments.show', $department)}}" class="uppercase underline hover:text-blue-600 cursor-pointer">
                                    {{$department->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$department->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteDepartment', '{{$department->id}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-action-section>

    {{-- edit a department --}}
    <x-dialog-modal wire:model="editForm.open">
        <x-slot name="title">
            Editar departemento
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
            livewire.on('deleteDepartment', departmentId => {
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
                        Livewire.emitTo('admin.department-component', 'delete',  departmentId)
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
