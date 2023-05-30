<div x-data>
    @if (!$quantity)
        <p class="text-gray-700 mb-4"><span class="font-semibold text-lg">Sin Stock Disponible ⛔</span> </p>
    @else
        <p class="text-gray-700 mb-4"><span class="font-semibold text-lg">Stock Disponible:</span> {{$quantity}}</p>
    @endif

    @if ($quantity)
        <div class="flex">
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
            
            <div class="flex-1 items-center justify-center">
                <x-button_custom color="green" class="w-full"
                    x-bind:disabled="$wire.qty > $wire.quantity"
                    wire:click="addItem"
                    wire:loading.attr="disabled"
                    wire:target="addItem"
                >
                    Agregar al carrito de compras
                </x-button_custom>
                {{-- <x-secondary-button 
                    x-bind:disabled="$wire.qty >= $wire.quantity"
                    wire:loading.attr="disabled"
                    wire:target="addItem"
                    class="w-full flex justify-center"
                    >
                    Agregar al carro
                </x-secondary-button> --}}
            </div>
        </div>
    @endif
</div>
