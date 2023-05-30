<div class="bg-white shadow-xl rounded-lg p-6 mb-4">
   <p class="text-2xl text-center font-semibold mb-2">
        Estado del producto
   </p>
   <div class="flex">
        <label class="mr-6">
            <input type="radio" wire:model="status" wire:model.defer name="status" value="2">
            Marcar producto como BORRADOR          
        </label>
        <label>
            <input type="radio" wire:model="status" wire:model.defer name="status" value="1">  
            Marcar producto como PUBLICADO             
        </label>
   </div>

   <div class="flex justify-end items-center">
        <x-action-message class="mr-3" on="saved">
            Actualizado
        </x-action-message>
        <x-button wire:click="save"
                  wire:loading.attr="disabled"
                  wire:target="save">
            Actualizar
        </x-button>
   </div>
</div>
