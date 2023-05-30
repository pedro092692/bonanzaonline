<div x-data>
    @if ($product->stock)
        <p class="text-xl text-gray-700 mb-1">Color: </p>
        <select class="form-control w-full" wire:model="color_id">
            <option value="" selected disabled>Selectionar un color</option>
            @foreach ($colors as $color)
                <option value="{{$color->id}}" class="capitalize">{{ __($color->name) }}</option>
            @endforeach
        </select>
    @endif
    @if ($quantity)
        <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Stock Color Disponible:</span> {{$quantity}}</p>
    @endif

    <div class="flex mt-4">
        @if ($product->stock && $quantity)
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
        @else
            @if ($color_id == '' && $product->stock)
                {{-- <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Selecciona un color</span> </p> --}}
            @else
                <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Sin Stock Disponible ⛔</span> </p>
            @endif
        @endif
    </div>
</div>
