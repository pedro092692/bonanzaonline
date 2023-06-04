<div class="container grid lg:grid-cols-2 xl:grid-cols-5 gap-6 py-8">
    <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3" x-data="{ shipping_type: @entangle('shipping_type') }">
       <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="mb-4">
                <x-label value="Nombre de contacto" />
                <x-input type="text" placeholder="Ingrese el nombre de la persona que recibirá el producto" class="w-full"
                         wire:model.defer="contact" 
                        />
                <x-input-error for="contact" />
            </div>
            <div>
                <x-label value="Teléfono de contacto" />
                <x-input type="text" x-mask="9999-999-99-99" placeholder="0424-999-99-99"  class="w-full" 
                         wire:model.defer="phone" required minlength="14"
                         />
                <x-input-error for="phone" />
            </div>
            
        <div>
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            
            <label class="bg-white rounded-lg shadow-lg px-6 py-4 flex items-center mb-4">
                <input x-model="shipping_type" type="radio" name="shipping_type" value="1" class="text-gray-600">
                
                <span class="ml-2 text-gray-700">Recogida en local (CC Residencias palo negro local 2-5) </span>
                
                <span class="font-semibold text-gray-700 ml-auto">Gratis</span>
            </label>
            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="shipping_type" type="radio" name="shipping_type" value="2" class="text-gray-600">
                    
                    <span class="ml-2 text-gray-700">Envio a domicilio</span>
                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': shipping_type != 2  }">
                    {{-- departments --}}
                    <div>
                        <x-label value="Estado" />
                        <select class="form-control w-full" wire:model="department_id">
                            <option value="" disabled selected>Selecciona un estado</option>
                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="department_id" />
                    </div>
                    {{-- cities --}}
                    <div>
                        <x-label value="Ciudades" />
                        <select class="form-control w-full" wire:model="city_id">
                            <option value="" disabled selected>Selecciona una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="city_id" />
                    </div>
                    {{-- districts--}}
                    <div>
                        <x-label value="Urbanización" />
                        <select class="form-control w-full" wire:model="district_id">
                            <option value="" disabled selected>Selecciona una urbanización</option>
                            @foreach ($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="district_id" />
                    </div>

                    <div>
                        <x-label value="Dirección" />
                        <x-input wire:model="address" type="text" class="w-full" />
                        <x-input-error for="address" />
                    </div>

                    <div class="col-span-2">
                        <x-label value="Referencia" />
                        <x-input wire:model="references" type="text" class="w-full" />
                        <x-input-error for="references" />
                        
                    </div>
                </div>
            </div>
        </div>

        <div>
            @if ( count(Cart::content()) ) 
                <x-button class="mt-6 mb-4"
                wire:loading.attr="disabled"
                wire:target="create_order"
                wire:click="create_order"
                >
                    Continuar con la compra
                </x-button>
            @else
                <x-button-link class="mt-6 mb-4" href="/">
                    No tienes nada en el carrito 😢
                </x-button-link>
            @endif
            

            <hr>
            <p class="mt-2 text-sm text-gray-700">Al continuar con la compra y proporcionarnos tu información personal, estás aceptando los siguientes términos: Recopilamos y utilizamos tu información personal para procesar y completar tus pedidos, comunicarnos contigo, mejorar nuestros productos y servicios, y personalizar tu experiencia de compra, puedes ver más información en nuestra<a href="{{route('privacy-policies')}}" class="text-blue-500 font-semibold"> Política de privacidad.</a> Gracias por preferirnos.</p>
        </div>

       </div>
    </div>
    <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-6  {{ count(Cart::content()) > 6 ? 'overflow-y-auto h-80 lg:h-2/4'  : '' }}"> 
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2">
                        <img class="h-15 w-20 object-cover mr-4 rounded-md" src="{{$item->options->image}}" alt="">
                        
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>
                            
                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="mx-2">- Color: {{ __($item->options['color']) }}</p>
                                @endisset
                                @isset($item->options['size'])
                                    <p>{{__('Size')}}: {{ __($item->options['size']) }}</p>
                                @endisset
                                @isset($item->options['weight'])
                                    <p class="mx-2">{{__('Weight')}}: {{ __($item->options['weight']) }}</p>

                                @endisset
                            </div>
                            <p>USD: {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">No tienes nada en el carrito 😢</p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mt-2">
            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{Cart::subtotal()}} USD</span>
                </p>
                <p class="flex justify-between items-center">
                    Envio
                    <span class="font-semibold">
                        @if ($shipping_type == 1 || $shipping_cost == 0)
                            Gratis
                        @else
                            {{$shipping_cost}} USD
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span> 
                    @if ($shipping_type == 1)
                        @if (isset($dollar_value->value))
                            {{Cart::subtotal()}} USD / {{Cart::subtotal() * $dollar_value->value }} Bs
                        @else
                            {{Cart::subtotal()}} USD
                        @endif
                    @else
                        @if (isset($dollar_value->value))
                            {{Cart::subtotal() + $shipping_cost}} USD / {{ (Cart::subtotal() + $shipping_cost)*$dollar_value->value }} Bs
                        @else
                            {{Cart::subtotal() + $shipping_cost}} USD
                        @endif
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
