<div class="container py-12">
    {{-- form create brand --}}
   <x-form-section submit="save" class="mb-6">
       <x-slot name="title">
           Agregar un nuevo peso
       </x-slot>

       <x-slot name="description">
           En esta seccion podra agragar nuevos pesos
       </x-slot>

       <x-slot name="form">
           <div class="col-span-6 sm:col-span-4">
               <x-label>
                   Nombre del peso
               </x-label>
               <x-input type="text" wire:model="createForm.name" class="w-full mt-1" placeholder="ej: 500g, 1kg, 1.5kg" />
               <x-input-error for="createForm.name" />
           </div>
           <div class="col-span-6 sm:col-span-4">
            <x-label>
                Factor de multiplicaion
            </x-label>
            <x-input type="number" wire:model="createForm.factor" class="w-full mt-1" placeholder="500gr->factor=0.5 1kg->factor=1" step="0.01" />
            <x-input-error for="createForm.factor" />
        </div>
       </x-slot>

       <x-slot name="actions">
           <x-button>
               Agregar
           </x-button>
       </x-slot>
   
   </x-form-section>
   {{-- show all brands --}}
   <x-action-section>
       <x-slot name="title">
           Lista de todos lod pesos
       </x-slot>
       
       <x-slot name="description">
           Aqui encontra todas los pesos guardados
       </x-slot>
       
       <x-slot name="content">
           <table class="text-gray-600">
               <thead class="border-b border-gray-300">
                   <tr class="text-left">
                       <th class="py-2 w-1/3">Nombre</th>
                       <th class="py-2 w-full">Factor de multiplicacion</th>
                       <th class="py-2">Accion</th>
                   </tr>
               </thead>
               <tbody class="divide-y divide-gray-300">
                   @foreach ($weights  as $weight)
                       <tr>
                           <td class="py-2">
                               <a class="uppercase">
                                   {{$weight->name}}
                               </a>
                           </td>
                           <td class="py-2">
                            <a class="uppercase">
                                {{$weight->factor}}
                            </a>
                        </td>
                           <td class="py-2">
                               <div class="flex divide-x divide-gray-300 font-semibold">
                                   <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$weight->id}}')">Editar</a>
                                   <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteWeight', '{{$weight->id}}')">Eliminar</a>
                               </div>
                           </td>
                       </tr>
                   @endforeach
               </tbody>
           </table>
       </x-slot>
   </x-action-section>
    {{-- edit brand --}}
    <x-dialog-modal wire:model="editForm.open">
       <x-slot name="title">
           Editar marca
       </x-slot>

       <x-slot name="content">
           <x-label>
               Nombre
           </x-label>
           <x-input type="text" wire:model="editForm.name" class="w-full" />
           <x-input-error for="editForm.name" />
           
           <x-label>
                Factor
            </x-label>
            <x-input type="number" step="0.01" wire:model="editForm.factor" class="w-full" />
            <x-input-error for="editForm.factor" />
       </x-slot>

       <x-slot name="footer">
           <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
               Actualizar
           </x-danger-button>
       </x-slot>
       
    </x-dialog-modal>
    
    @push('script')
       <script>
           livewire.on('deleteWeight', weightId => {
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
                       Livewire.emitTo('admin.weight-component', 'delete',  weightId)
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
