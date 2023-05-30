<div x-data>
    @if (count($product->weights))
        <p class="text-xl text-gray-700 mb-1">Peso: </p>
        <select class="form-control w-full" wire:model="weight_id">
            <option value="" selected disabled>Selectionar una cantidad</option>
            @foreach ($weights as $weight)
                <option value="{{$weight->id}}" class="capitalize">{{ __($weight->name) }}</option>
            @endforeach
        </select>
    @else
        <p class="text-gray-700 mt-4"><span class="font-semibold text-lg">Sin Stock Disponible <i class="fa-solid fa-circle-xmark text-red-700"></i></span> </p> 
    @endif
    @if($quantity)
        <p class="text-gray-700 mt-4"><span class="font-semibold text-lg">Stock Disponible:</span> {{$quantity}}</p>       
    @endif
    @if($quantity || $weight_id == "")
        <div class="flex mt-6">
            
        @if ($weight_id != "")
            <div class="mr-6">
                <x-secondary-button 
                    disabled
                    x-bind:disabled="$wire.qty <= 1"
                    wire:loading.attr="disabled"
                    wire:target="decrement"
                    wire:click="decrement">
                    -
                </x-secondary-button>
                
                <span class="mx-2 text-gray-700">{{$qty}}</span>
                
                <x-secondary-button 
                    x-bind:disabled="$wire.qty >= $wire.quantity"
                    wire:loading.attr="disabled"
                    wire:target="increment"
                    wire:click="increment">
                    +
                </x-secondary-button>
            </div>
            
                <div class="flex-1">
                    <x-button_custom 
                        x-bind:disabled="$wire.qty > $wire.quantity"
                        color="green" class="w-full"
                        wire:click="addItem"
                        wire:loading.attr="disabled"
                        wire:target="addItem"
                        >
                        Agregar al carrito de compras
                    </x-button_custom>
                </div>
            @endif
        </div>
    @else
        <p class="text-gray-700 mt-4 mb-4"><span class="font-semibold text-lg">Sin Stock Disponible ⛔</span> </p>      
    @endif
</div>
