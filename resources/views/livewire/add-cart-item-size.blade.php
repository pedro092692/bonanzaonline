<div x-data>

    @if ($product->stock)
        {{-- sizes --}}
        <div class="mb-4">
            <p class="text-xl text-gray-700 mb-1">Talla: </p>
            <select wire:model="size_id" class="form-control w-full">
                <option value=""selected disabled>Selecciona una talla</option>
                @foreach ($sizes as $size)
                    <option value="{{$size->id}}">{{$size->name}}</option>
                @endforeach
            </select>
        </div>
        {{-- colors --}}
        <div>
            <p class="text-xl text-gray-700 mb-1">Color: </p>
            <select wire:model="color_id" class="form-control w-full">
                <option value=""selected disabled>Selecciona un color</option>
                @foreach ($colors as $color)
                    <option value="{{$color->id}}">{{ __($color->name) }}</option>
                @endforeach
            </select>
        </div>
    @endif
    @if (!$product->stock)
        <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Sin Stock Disponible ⛔</span> </p>
    @elseif($quantity)
        <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Stock Talla Disponible:</span> {{$quantity}}</p>
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
                    x-bind:disabled="!$wire.quantity"
                    color="green" class="w-full"
                    wire:click="addItem"
                    wire:loading.attr="disabled"
                    wire:target="addItem"
                    >
                    Agregar al carrito de compras
                </x-button_custom>
            </div>
        @else
            @if ($size_id == '' || $color_id == '')
                <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Selecciona una talla y un color</span> </p>
            @else
                <p class="text-gray-700 my-4"><span class="font-semibold text-lg">Sin Stock Disponible ⛔</span> </p>
            @endif
           
        @endif
    </div>
</div>
